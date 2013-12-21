<?php

require_once(__DIR__.'/../config.php');

class File_IO {

    const MAX_FILE_SIZE = CONFIG_MAX_FILE_SIZE; // int from config.php in root directory
    const UPLOAD_ERROR_COULD_NOT_OPEN = 1;
    const UPLOAD_ERROR_COULD_NOT_PROCESS = 2;
    const UPLOAD_ERROR_TOO_LARGE = 3;
    const UPLOAD_ERROR_XML_INVALID = 4;
    const UPLOAD_ERROR_NO_TRANSLATIONS_FOUND = 5;
    const FILENAME_REGEX = '/^[a-z]+[a-z0-9_.]*$/';
	const HTML_ESCAPING_NONE = 0;
	const HTML_ESCAPING_GETTEXT = 1;
	const HTML_ESCAPING_HTML_FROMHTML = 2;

    public static function getMaxFileSize() {
        return self::MAX_FILE_SIZE;
    }

    /**
     * Compresses a given folder to a ZIP file
     *
     * @param string $inputFolder the source folder that is to be zipped
     * @param string $zipOutputFile the destination file that the ZIP is to be written to
     * @return boolean whether this process was successful or not
     */
	function zipFolder($inputFolder, $zipOutputFile) {
		if (!extension_loaded('zip') || !file_exists($inputFolder)) {
			return false;
		}

		$zip = new ZipArchive();
		if (!$zip->open($zipOutputFile, ZIPARCHIVE::CREATE)) {
			return false;
		}

		$inputFolder = str_replace('\\', '/', realpath($inputFolder));

		if (is_dir($inputFolder) === true) {
			$files = new RecursiveIteratorIterator(
				new RecursiveDirectoryIterator(
					$inputFolder,
					FilesystemIterator::SKIP_DOTS | FilesystemIterator::UNIX_PATHS
				),
				RecursiveIteratorIterator::SELF_FIRST
			);

			foreach ($files as $file) {
				$file = str_replace('\\', '/', $file);

				if (is_dir($file) === true) {
					$dirName = str_replace($inputFolder.'/', '', $file.'/');
					$zip->addEmptyDir($dirName);
				}
				else if (is_file($file) === true) {
					$fileName = str_replace($inputFolder.'/', '', $file);
					$zip->addFromString($fileName, file_get_contents($file));
				}
			}
		}
		else if (is_file($inputFolder) === true) {
			$zip->addFromString(basename($inputFolder), file_get_contents($inputFolder));
		}

		return $zip->close();
	}

    /**
     * Recursively deletes a directory and its content
     *
     * @param string $dir directory to delete recursively
     */
    public static function deleteDirectoryRecursively($dir) {
        $files = glob($dir.'/*');
        if (!empty($files)) {
            foreach ($files as $file) { // loop through child elements
                if (is_dir($file)) {
                    self::deleteDirectoryRecursively($file); // delete directories in this directory
                }
                else {
                    unlink($file); // delete files in this directory
                }
            }
        }
        rmdir($dir); // delete this directory itself
    }

    public static function isFilenameValid($filename) {
        return isset($filename) && preg_match(self::FILENAME_REGEX, $filename);
    }

    /**
     * Exports the given repository and creates a ZIP file containing XML output files
     *
     * @param Repository $repository the Repository instance to export
     * @param string $filename the output file name inside each language folder
     * @param int $groupID the group to get the output for (or Phrase::GROUP_ALL)
     * @param bool $escapeHTML whether to escape HTML tags inside the content or not
     * @param int $minCompletion the minimum percentage of completion for languages to be eligible for exporting
     * @throws Exception if the repository could not be exported
     */
    public static function exportRepository($repository, $filename, $groupID, $escapeHTML = false, $minCompletion = 0) {
        $filename = str_replace('.xml', '', $filename); // drop file extension (will be appended automatically)
        if (self::isFilenameValid($filename)) {
            if ($repository instanceof Repository) {
                $export_success = true;
                $randomDir = mt_rand(1000000, 9999999);
                $savePath = URL::getTempPath(false).URL::encodeID($repository->getID());
                self::deleteDirectoryRecursively($savePath); // delete all old output files from output directory first
                $savePath .= '/'.$randomDir; // navigate to random directory inside output folder
                if (mkdir($savePath, 0755, true)) { // if output folder could be created
                    $languages = Language::getList();
                    foreach ($languages as $language) {
                        $languageObject = $repository->getLanguage($language);
                        $languageKey = $languageObject->getKey();
                        $xmlOutput = $languageObject->output($escapeHTML, $groupID);
                        if ($xmlOutput->getCompleteness() >= $minCompletion) {
                            if (mkdir($savePath.'/'.$languageKey.'/', 0755, true)) {
                                    if (file_put_contents($savePath.'/'.$languageKey.'/'.$filename.'.xml', $xmlOutput->getContent())) {
                                        $export_success = true;
                                    }
                                    else { // output file could not be written
                                        $export_success = false;
                                    }
                            }
                            else { // sub-directory for language could not be created
                                $export_success = false;
                            }
                        }
                    }
                }
                else { // output folder could not be created
                    $export_success = false;
                }
                if ($export_success) {
                    $outputPath = URL::getTempPath(true).URL::encodeID($repository->getID()).'/'.$randomDir;
                    if (self::zipFolder($savePath, $savePath.'/Export.zip')) {
                        header('Location: '.$outputPath.'/Export.zip');
                        exit;
                    }
                }
            }
            else {
                throw new Exception('The repository must be an instance of class Repository');
            }
        }
        else {
            throw new Exception('Invalid filename: '.$filename);
        }
    }

    public static function importXML($repositoryID, $fileArrayValue) {
        if ($fileArrayValue['size'] < self::getMaxFileSize()) {
            $newFileName = URL::getUploadPath(false).$repositoryID.'_'.mt_rand(1000000, 9999999).'.xml';
            if (move_uploaded_file($fileArrayValue['tmp_name'], $newFileName)) {
                $fileContent = file_get_contents($newFileName);
                if ($fileContent !== false) {
                    $fileContent = str_replace('<![CDATA[', '', $fileContent);
                    $fileContent = str_replace(']]>', '', $fileContent);
                    $fileContent = preg_replace('/<string-array([^>]*)>/i', '<entryList\1>', $fileContent);
                    $fileContent = str_replace('</string-array>', '</entryList>', $fileContent);
                    $fileContent = preg_replace('/<string([^>]*)>/i', '<entrySingle\1><![CDATA[', $fileContent);
                    $fileContent = str_replace('</string>', ']]></entrySingle>', $fileContent);
                    $fileContent = preg_replace('/<item([^>]*)>/i', '<item\1><![CDATA[', $fileContent);
                    $fileContent = str_replace('</item>', ']]></item>', $fileContent);
                    $xml = @simplexml_load_string($fileContent, 'SimpleXMLElement', LIBXML_NOCDATA);
                    if ($xml != false) {
                        $importedPhrases = array();
                        foreach ($xml->{'entrySingle'} as $entrySingle) {
                            $entryAttributes = $entrySingle->attributes();
                            $importedPhrase = new Phrase_Android_String(0, trim($entryAttributes['name']), true);
                            $importedPhrase->addValue(trim(Phrase_Android::readFromRaw($entrySingle[0])));
                            $importedPhrases[] = $importedPhrase;
                        }
                        foreach ($xml->{'entryList'} as $entryList) {
                            $entryAttributes = $entryList->attributes();
                            $importedPhrase = new Phrase_Android_StringArray(0, trim($entryAttributes['name']), true);
                            foreach ($entryList->{'item'} as $entryItem) {
                                $importedPhrase->addValue(trim(Phrase_Android::readFromRaw($entryItem)));
                            }
                            $importedPhrases[] = $importedPhrase;
                        }
                        foreach ($xml->{'plurals'} as $plural) {
                            $pluralAttributes = $plural->attributes();
                            $importedPhrase = new Phrase_Android_Plurals(0, trim($pluralAttributes['name']), true);
                            foreach ($plural->{'item'} as $pluralItem) {
                                $itemAttributes = $pluralItem->attributes();
                                $importedPhrase->addValue(trim(Phrase_Android::readFromRaw($pluralItem)), trim($itemAttributes['quantity']));
                            }
                            $importedPhrases[] = $importedPhrase;
                        }
                        if (count($importedPhrases) > 0) {
                            return $importedPhrases;
                        }
                        else {
                            return self::UPLOAD_ERROR_NO_TRANSLATIONS_FOUND;
                        }
                    }
                    else {
                        return self::UPLOAD_ERROR_XML_INVALID;
                    }
                }
                else {
                    return self::UPLOAD_ERROR_COULD_NOT_OPEN;
                }
            }
            else {
                return self::UPLOAD_ERROR_COULD_NOT_PROCESS;
            }
        }
        else {
            return self::UPLOAD_ERROR_TOO_LARGE;
        }
    }

}

?>
