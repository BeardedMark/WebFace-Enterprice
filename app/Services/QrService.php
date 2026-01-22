<?php

namespace App\Services;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class QrService
{
    protected string $data = '';
    protected ?string $logoPath = null;
    protected int $size = 200;
    protected int $margin = 10;
    protected string $encoding = 'UTF-8';
    protected string $errorCorrection = 'high';
    protected string $format = 'png';

    /**
     * Установить исходные данные для QR (текст, vCard, URL и т.д.)
     */
    public function setData(string $data): static
    {
        $this->data = $data;
        return $this;
    }

    /**
     * Установить путь к логотипу
     */
    public function setLogo(string $path): static
    {
        $this->logoPath = $path;
        return $this;
    }

    /**
     * Настроить размер
     */
    public function setSize(int $size): static
    {
        $this->size = $size;
        return $this;
    }

    /**
     * Настроить отступ
     */
    public function setMargin(int $margin): static
    {
        $this->margin = $margin;
        return $this;
    }

    /**
     * Установить формат вывода (png, svg, base64)
     */
    public function setFormat(string $format): static
    {
        $this->format = strtolower($format);
        return $this;
    }

    /**
     * Генерация QR и возврат результата в выбранном формате
     */
    public function generate(): string
    {
        $writer = match ($this->format) {
            'png' => new PngWriter(),
            default => new PngWriter(),
        };

        $builder = new Builder(
            writer: $writer,
            writerOptions: [],
            validateResult: false,
            data: $this->data,
            encoding: new Encoding($this->encoding),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: $this->size,
            margin: $this->margin,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
            logoPath: $this->logoPath,
        );

        $result = $builder->build();

        return match ($this->format) {
            'base64', 'datauri' => $result->getDataUri(),
            'png' => $result->getString(),
            default => $result->getDataUri(),
        };
    }

    /**
     * Утилита: создать QR для vCard по массиву контактов
     */
    public function generateVCard(array $data): string
    {
        $vcard = "BEGIN:VCARD\nVERSION:3.0\n";
        $map = [
            'title' => 'TITLE',
            'phone' => 'TEL:+7',
            'email' => 'EMAIL',
            'person' => 'FN',
            'organization' => 'ORG',
            'note' => 'NOTE',
            'geo' => 'ADR',
        ];

        foreach ($map as $key => $label) {
            if (isset($data[$key])) {
                $prefix = str_starts_with($label, 'TEL') ? '' : '';
                $vcard .= "{$label}:" . $data[$key] . "\n";
            }
        }

        if (isset($data['url'])) {
            $vcard .= "URL:" . $data['url'] . "\n";
        }

        $vcard .= "END:VCARD";

        return $this->setData($vcard)->generate();
    }
}
