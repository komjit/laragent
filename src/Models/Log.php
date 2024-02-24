<?php

namespace KomjIT\LarAgent\Models;

use Illuminate\Support\Facades\Log as LaravelLog;

/**
 * A Számla Agent naplózását végző osztály
 *
 * @package LarAgent
 */
class Log
{
    /**
     * Alapértelmezett naplófájl elnevezés
     */
    const LOG_FILENAME = 'szamlaagent';

    /**
     * Naplók útvonala
     */
    const LOG_PATH = '/storage/logs/LarAgent';

    /**
     * Naplózási szint: nincs naplózás
     */
    const LOG_LEVEL_OFF = 0;

    /**
     * Naplózási szint: hibák
     */
    const LOG_LEVEL_ERROR = 1;

    /**
     * Naplózási szint: figyelmeztetések
     */
    const LOG_LEVEL_WARN = 2;

    /**
     * Naplózási szint: fejlesztői (debug)
     */
    const LOG_LEVEL_DEBUG = 3;

    /**
     * Elérhető naplózási szintek
     */
    private static $logLevels = array(
        self::LOG_LEVEL_OFF,
        self::LOG_LEVEL_ERROR,
        self::LOG_LEVEL_WARN,
        self::LOG_LEVEL_DEBUG
    );

    /**
     * Naplózási fájl elnevezés
     *
     * @var string
     */
    private $logFileName = self::LOG_FILENAME;

    /**
     * Naplózási útvonal
     *
     * @var string
     */
    private $logPath = self::LOG_PATH;

    /**
     * @var Log
     */
    protected static $instance;


    /**
     * Log constructor.
     *
     * @param string $logPath
     * @param string $fileName
     */
    protected function __construct($logPath = self::LOG_PATH, $fileName = self::LOG_FILENAME)
    {
        $this->logPath = $logPath;
        $this->logFileName = $fileName . '_' . date('Y-m-d') . '.log';
    }

    /**
     * @return string
     */
    public function getLogFileName()
    {
        return $this->logFileName;
    }

    /**
     * @param $fileName
     */
    public function setLogFileName($fileName)
    {
        $this->logFileName = $fileName;
    }

    /**
     * @return string
     */
    public function getLogPath()
    {
        return $this->logPath;
    }

    /**
     * @param string $logPath
     */
    public function setLogPath($logPath)
    {
        $this->logPath = $logPath;
    }

    /**
     * @return Log
     */
    public static function get()
    {
        $instance = self::$instance;
        if ($instance === null) {
            return self::$instance = new self();
        } else {
            return $instance;
        }
    }

    /**
     * Üzenetek naplózása logfájlba
     * Igény szerint e-mail küldése a megadott címre.
     *
     * @param string $pMessage
     * @param int $pType
     * @param string $pEmail
     */
    public static function writeLog($pMessage, $pType = self::LOG_LEVEL_DEBUG)
    {
        $log = Log::get();
        $remoteAddr = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '';
        $logLevel = $log->getLogTypeStr($pType);
        $logType = SzamlaAgentUtil::isNotBlank($logLevel) ? ' [' . $logLevel . '] ' : '';
        $message = '[' . date('Y-m-d H:i:s') . '] [' . $remoteAddr . ']' . $logType . $pMessage . PHP_EOL;

        LaravelLog::channel(config('logging.default'))->{$logLevel}('SzamlazzHu:',
        [
            'method' => __METHOD__,
            'logText' => $message,
        ]);
    }

    /**
     * Visszaadja a naplózás típusának elnevezését
     *
     * @param $type
     * @return string
     */
    protected function getLogTypeStr($type)
    {
        switch ($type) {
            case self::LOG_LEVEL_ERROR:
                $name = 'error';
                break;
            case self::LOG_LEVEL_WARN:
                $name = 'warn';
                break;
            case self::LOG_LEVEL_DEBUG:
                $name = 'debug';
                break;
            default:
                $name = 'info';
                break;
        }
        return $name;
    }

    /**
     * @param $logLevel
     *
     * @return bool
     */
    public static function isValidLogLevel($logLevel)
    {
        return (in_array($logLevel, self::$logLevels));
    }

    /**
     * @param $logLevel
     *
     * @return bool
     */
    public static function isNotValidLogLevel($logLevel)
    {
        return !self::isValidLogLevel($logLevel);
    }
}
