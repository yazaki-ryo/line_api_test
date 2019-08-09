<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\PrintSettingRepository;

final class PrintSetting extends DomainModel
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $pcPosition;

    /** @var Flag */
    private $pcFrame;

    /** @var Flag */
    private $pcSymbol;

    /** @var int */
    private $pcX;

    /** @var int */
    private $pcY;

    /** @var string */
    private $pcFont;

    /** @var int */
    private $pcFontSize;

    /** @var int */
    private $addressX;

    /** @var int */
    private $addressY;

    /** @var string */
    private $addressFont;

    /** @var int */
    private $addressFontSize;

    /** @var int */
    private $nameX;

    /** @var int */
    private $nameY;

    /** @var string */
    private $nameFont;

    /** @var int */
    private $nameFontSize;

    /** @var int */
    private $storeNameFontSize;

    /** @var int */
    private $departmentNameFontSize;

    /** @var Flag */
    private $fromFlag;

    /** @var string */
    private $fromPcPosition;

    /** @var Flag */
    private $fromPcSymbol;

    /** @var int */
    private $fromPcX;

    /** @var int */
    private $fromPcY;

    /** @var string */
    private $fromPcFont;

    /** @var int */
    private $fromPcFontSize;

    /** @var int */
    private $fromAddressX;

    /** @var int */
    private $fromAddressY;

    /** @var string */
    private $fromAddressFont;

    /** @var int */
    private $fromAddressFontSize;

    /** @var int */
    private $fromNameX;

    /** @var int */
    private $fromNameY;

    /** @var string */
    private $fromNameFont;

    /** @var int */
    private $fromNameFontSize;

    /** @var int */
    private $fromPersonalNameX;

    /** @var int */
    private $fromPersonalNameY;

    /** @var string */
    private $fromPersonalNameFont;

    /** @var int */
    private $fromPersonalNameFontSize;

    /** @var Datetime */
    private $createdAt;

    /** @var Datetime */
    private $updatedAt;

    /**
     * @param PrintSettingRepository $repo
     * @return void
     */
    public function __construct(PrintSettingRepository $repo)
    {
        $this->repo = is_null($repo) ? new PrintSettingRepository : $repo;
    }

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function pcPosition(): ?string
    {
        return $this->pcPosition;
    }

    /**
     * @return Flag|null
     */
    public function pcFrame(): ?Flag
    {
        return $this->pcFrame;
    }

    /**
     * @return Flag|null
     */
    public function pcSymbol(): ?Flag
    {
        return $this->pcSymbol;
    }

    /**
     * @return int|null
     */
    public function pcX(): ?int
    {
        return $this->pcX;
    }

    /**
     * @return int|null
     */
    public function pcY(): ?int
    {
        return $this->pcY;
    }

    /**
     * @return string|null
     */
    public function pcFont(): ?string
    {
        return $this->pcFont;
    }

    /**
     * @return int|null
     */
    public function pcFontSize(): ?int
    {
        return $this->pcFontSize;
    }

    /**
     * @return int|null
     */
    public function addressX(): ?int
    {
        return $this->addressX;
    }

    /**
     * @return int|null
     */
    public function addressY(): ?int
    {
        return $this->addressY;
    }

    /**
     * @return string|null
     */
    public function addressFont(): ?string
    {
        return $this->addressFont;
    }

    /**
     * @return int|null
     */
    public function addressFontSize(): ?int
    {
        return $this->addressFontSize;
    }

    /**
     * @return int|null
     */
    public function nameX(): ?int
    {
        return $this->nameX;
    }

    /**
     * @return int|null
     */
    public function nameY(): ?int
    {
        return $this->nameY;
    }

    /**
     * @return string|null
     */
    public function nameFont(): ?string
    {
        return $this->nameFont;
    }

    /**
     * @return int|null
     */
    public function nameFontSize(): ?int
    {
        return $this->nameFontSize;
    }

    /**
     * @return int|null
     */
    public function storeNameFontSize(): ?int
    {
        return $this->storeNameFontSize;
    }

    /**
     * @return int|null
     */
    public function departmentNameFontSize(): ?int
    {
        return $this->departmentNameFontSize;
    }

    /**
     * @return Flag|null
     */
    public function fromFlag(): ?Flag
    {
        return $this->fromFlag;
    }

    /**
     * @return string|null
     */
    public function fromPcPosition(): ?string
    {
        return $this->fromPcPosition;
    }

    /**
     * @return Flag|null
     */
    public function fromPcSymbol(): ?Flag
    {
        return $this->fromPcSymbol;
    }

    /**
     * @return int|null
     */
    public function fromPcX(): ?int
    {
        return $this->fromPcX;
    }

    /**
     * @return int|null
     */
    public function fromPcY(): ?int
    {
        return $this->fromPcY;
    }

    /**
     * @return string|null
     */
    public function fromPcFont(): ?string
    {
        return $this->fromPcFont;
    }

    /**
     * @return int|null
     */
    public function fromPcFontSize(): ?int
    {
        return $this->fromPcFontSize;
    }

    /**
     * @return int|null
     */
    public function fromAddressX(): ?int
    {
        return $this->fromAddressX;
    }

    /**
     * @return int|null
     */
    public function fromAddressY(): ?int
    {
        return $this->fromAddressY;
    }

    /**
     * @return string|null
     */
    public function fromAddressFont(): ?string
    {
        return $this->fromAddressFont;
    }

    /**
     * @return int|null
     */
    public function fromAddressFontSize(): ?int
    {
        return $this->fromAddressFontSize;
    }

    /**
     * @return int|null
     */
    public function fromNameX(): ?int
    {
        return $this->fromNameX;
    }

    /**
     * @return int|null
     */
    public function fromNameY(): ?int
    {
        return $this->fromNameY;
    }

    /**
     * @return string|null
     */
    public function fromNameFont(): ?string
    {
        return $this->fromNameFont;
    }

    /**
     * @return int|null
     */
    public function fromNameFontSize(): ?int
    {
        return $this->fromNameFontSize;
    }

    /**
     * @return int|null
     */
    public function fromPersonalNameX(): ?int
    {
        return $this->fromPersonalNameX;
    }

    /**
     * @return int|null
     */
    public function fromPersonalNameY(): ?int
    {
        return $this->fromPersonalNameY;
    }

    /**
     * @return string|null
     */
    public function fromPersonalNameFont(): ?string
    {
        return $this->fromPersonalNameFont;
    }

    /**
     * @return int|null
     */
    public function fromPersonalNameFontSize(): ?int
    {
        return $this->fromPersonalNameFontSize;
    }

    /**
     * @return Datetime|null
     */
    public function createdAt(): ?Datetime
    {
        return $this->createdAt;
    }

    /**
     * @return Datetime|null
     */
    public function updatedAt(): ?Datetime
    {
        return $this->updatedAt;
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        return $this->repo->user();
    }

    /**
     * @param PrintSettingRepository $repo
     * @return self
     */
    public static function of(PrintSettingRepository $repo): self
    {
        return (new self($repo))->propertiesByArray($repo->attributesToArray());
    }

    /**
     * @param array $args
     * @return self
     */
    public static function ofByArray(array $args = []): self
    {
        return (new self(new PrintSettingRepository))->propertiesByArray($args);
    }

    /**
     * @param array $args
     * @return array
     */
    public static function domainizeAttributes(array $args = []): array
    {
        $args = collect($args);

        if ($args->has($key = 'test')) {
//             $args->put($key, 'test');
        }

        return $args->all();
    }

    /**
     * @param array $args
     * @return self
     */
    protected function propertiesByArray(array $args = []): self
    {
        $args = collect($args);

        if ($args->has($key = 'id')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'data')) {
            $this->propertiesByJson($args->get($key));
        }

        if ($args->has($key = 'created_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        if ($args->has($key = 'updated_at')) {
            $this->{$camel = camel_case($key)} = is_null($args->get($key)) ? null : Datetime::of($args->get($key));
        }

        return $this;
    }

    /**
     * @param string $json
     * @return self
     */
    private function propertiesByJson(string $json): self
    {
        $args = collect(json_decode($json, true));

        if ($args->has($key = 'name')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'pc_position')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'pc_frame')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$args->get($key));
        }

        if ($args->has($key = 'pc_symbol')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$args->get($key));
        }

        if ($args->has($key = 'pc_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'pc_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'pc_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'pc_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'address_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'address_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'address_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'address_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'name_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'name_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'name_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'name_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'store_name_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'department_name_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_flag')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$args->get($key));
        }

        if ($args->has($key = 'from_pc_position')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'from_pc_symbol')) {
            $this->{$camel = camel_case($key)} = Flag::of((bool)$args->get($key));
        }

        if ($args->has($key = 'from_pc_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_pc_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_pc_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'from_pc_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_address_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_address_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_address_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'from_address_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_name_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_name_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_name_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'from_name_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_personal_name_x')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_personal_name_y')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        if ($args->has($key = 'from_personal_name_font')) {
            $this->{$camel = camel_case($key)} = $args->get($key);
        }

        if ($args->has($key = 'from_personal_name_font_size')) {
            $this->{$camel = camel_case($key)} = (int)$args->get($key);
        }

        return $this;
    }

}
