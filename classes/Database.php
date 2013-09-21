<?php

require_once(__DIR__.'/../config.php');

class Database {

    const DB_CONNECT_STRING = CONFIG_DB_CONNECT_STRING; // string from config.php in root directory
    const DB_USERNAME = CONFIG_DB_USERNAME; // string from config.php in root directory
    const DB_PASSWORD = CONFIG_DB_PASSWORD; // string from config.php in root directory
    const TABLE_USERS_SEQUENCE = NULL; // needed on same DB systems (e.g. Postgres) for getLastInsertID()
    const TABLE_REPOSITORIES_SEQUENCE = NULL; // needed on same DB systems (e.g. Postgres) for getLastInsertID()

    protected static $db;

    public static function init() {
        try {
            self::$db = new PDO(self::DB_CONNECT_STRING, self::DB_USERNAME, self::DB_PASSWORD);
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (Exception $e) {
            throw new Exception('Could not connect to database');
        }
    }

    public static function escape($text) {
        return self::$db->quote($text);
    }

    public static function select($sql_string) {
        $result = self::$db->query($sql_string);
        return $result->fetchAll();
    }

    public static function selectFirst($sql_string) {
        $result = self::$db->query($sql_string);
        return $result->fetch();
    }

    public static function insert($sql_string) {
        self::$db->exec($sql_string);
    }

    public static function update($sql_string) {
        self::$db->exec($sql_string);
    }

    public static function delete($sql_string) {
        self::$db->exec($sql_string);
    }

    public static function getLastInsertID($sequenceName) {
        return self::$db->lastInsertId($sequenceName);
    }

    public static function getRepositoryData($id) {
        if ($id > 0) {
            return Database::selectFirst("SELECT name, visibility, defaultLanguage FROM repositories WHERE id = ".intval($id));
        }
        else {
            return NULL;
        }
    }

    public static function getLanguageData($id) {
        if ($id > 0) {
            return new Language_Android($id);
        }
        else {
            return NULL;
        }
    }

    public static function getRepositoryRole($userID, $repositoryID) {
        $role = Database::selectFirst("SELECT role FROM roles WHERE userID = ".intval($userID)." AND repositoryID = ".intval($repositoryID));
        if (empty($role)) {
            return Repository::ROLE_NONE;
        }
        else {
            return $role['role'];
        }
    }

    public static function addPhrase($repositoryID, $languageID, $phraseKey, $payload) {
        self::insert("INSERT INTO phrases (repositoryID, languageID, phraseKey, enabled, payload) VALUES (".intval($repositoryID).", ".intval($languageID).", ".self::escape($phraseKey).", 1, ".self::escape($payload).")");
    }

    public static function addPhrases($repositoryID, $languageID, $phraseObjects, $doOverwrite) {
        $values = "";
        $counter = 0;
        foreach ($phraseObjects as $phraseObject) {
            if ($phraseObject instanceof Phrase) {
                if ($counter > 0) {
                    $values .= ",";
                }
                $values .= "(".intval($repositoryID).", ".intval($languageID).", ".self::escape($phraseObject->getPhraseKey()).", 1, ".self::escape($phraseObject->getPayload()).")";
                $counter++;
            }
            else {
                throw new Exception('Phrase objects must be instances of class Phrase');
            }
        }
        if (!empty($values)) {
            if ($doOverwrite) {
                self::insert("INSERT INTO phrases (repositoryID, languageID, phraseKey, enabled, payload) VALUES ".$values." ON DUPLICATE KEY UPDATE payload = VALUES(payload)");
            }
            else {
                self::insert("INSERT IGNORE INTO phrases (repositoryID, languageID, phraseKey, enabled, payload) VALUES ".$values);
            }
        }
    }

    public static function submitEdits($repositoryID, $languageID, $userID, $editObjects) {
        $values = "";
        $counter = 0;
        foreach ($editObjects as $editObject) {
            if ($editObject instanceof Edit) {
                if ($counter > 0) {
                    $values .= ",";
                }
                $values .= "(".intval($repositoryID).", ".intval($languageID).", ".intval($editObject->getReferencedPhraseID()).", ".self::escape($editObject->getPhraseSubKey()).", ".intval($userID).", ".self::escape($editObject->getSuggestedValue()).", ".time().")";
                $counter++;
            }
            else {
                throw new Exception('Edit objects must be instances of class Edit');
            }
        }
        if (!empty($values)) {
            self::insert("INSERT INTO edits (repositoryID, languageID, referencedPhraseID, phraseSubKey, userID, suggestedValue, submit_time) VALUES ".$values." ON DUPLICATE KEY UPDATE suggestedValue = VALUES(suggestedValue)");
        }
    }

    public static function getNativeLanguages($userID) {
        $out = array();
        $entries = self::select("SELECT languageID FROM native_languages WHERE userID = ".intval($userID));
        foreach ($entries as $entry) {
            $out[] = $entry['languageID'];
        }
        return $out;
    }

    public static function updateAccountInfo($userID, $realName, $nativeLanguages) {
        self::update("UPDATE users SET real_name = ".self::escape($realName)." WHERE id = ".intval($userID));
        self::delete("DELETE FROM native_languages WHERE userID = ".intval($userID));
        if (is_array($nativeLanguages) && count($nativeLanguages) > 0) {
            $values = "";
            $counter = 0;
            foreach ($nativeLanguages as $nativeLanguage) {
                if ($counter > 0) {
                    $values .= ",";
                }
                $values .= "(".intval($userID).", ".intval($nativeLanguage).")";
                $counter++;
            }
            self::insert("INSERT INTO native_languages (userID, languageID) VALUES ".$values);
        }
    }

}