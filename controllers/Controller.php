<?php
require_once(__DIR__ . '/../lib/data.php');

class Controller
{
    private const CONFIG_FILE = __DIR__ . '/../config/config.php';
    private Data $data;

    public function __construct()
    {
        $this->data = new Data();
    }

    public function showConfig(): void
    {
        $config = $this->loadConfig();
        $content = $this->render('config_panel/index', ['configSections' => $config]);

        echo $this->render('layout', ['content' => $content]);
    }

    private function loadConfig(): array {
        $config = [];

        if (file_exists(self::CONFIG_FILE)) {
            include self::CONFIG_FILE;

            return [
                'mail'            => $config['mail']            ?? [],
                'deepl_translate' => $config['deepl_translate'] ?? [],
                'recaptcha'       => $config['recaptcha']       ?? [],
                'telegram_bot'    => $config['telegram_bot']    ?? [],
                'googlesignin'    => $config['googlesignin']    ?? [],
            ];
        }

        return [];
    }

    public function saveConfig(): void
    {
        header('Content-Type: application/json');

        $configKey = $this->data->post('configKey');
        $configData = $this->data->post('configData');


        if (!$configKey || !$configData) {
            echo json_encode(['error' => 'Missing required parameters']);
            return;
        }

        if (is_string($configData)) {
            $configData = json_decode($configData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo json_encode(['error' => 'Invalid configData JSON']);
                return;
            }
        } elseif (!is_array($configData)) {
            echo json_encode(['error' => 'configData must be array or JSON string']);
            return;
        }

        if (!is_writable(self::CONFIG_FILE)) {
            echo json_encode(['error' => 'Config file is not writable']);
            return;
        }

        $fileContent = file_get_contents(self::CONFIG_FILE);
        if ($fileContent === false) {
            echo json_encode(['error' => 'Failed to read config file']);
            return;
        }

        $exportedValue = var_export($configData, true);

        $pattern = "/(\\\$config\\s*\\[\\s*['\"]" . preg_quote($configKey, '/') . "['\"]\\s*\\]\\s*=\\s*)([^;]*);/";

        if (preg_match($pattern, $fileContent)) {
            $newContent = preg_replace($pattern, '$1' . $exportedValue . ';', $fileContent, 1);

            if (file_put_contents(self::CONFIG_FILE, $newContent) === false) {
                echo json_encode(['error' => 'Failed to write config file']);
                return;
            }

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => "Config key '{$configKey}' not found in config.php"]);
        }
    }

    private function render($view, $data = []): bool|string
    {
        extract($data);
        ob_start();
        include "views/$view.php";
        return ob_get_clean();
    }
}