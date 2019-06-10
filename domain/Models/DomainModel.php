<?php
declare(strict_types=1);

namespace Domain\Models;

use App\Repositories\EloquentRepository;
use Domain\Traits\Models\Synchronizable;

abstract class DomainModel
{
    use Synchronizable;
    
    private static $exportPropertiesCache = [];

    /** @var EloquentRepository */
    protected $repo;

    /**
     * @return void
     */
    public function delete(): void
    {
        $this->repo->delete($this->id());
    }

    /**
     * @return void
     */
    public function restore(): void
    {
        $this->repo->restore($this->id());
    }

    /**
     * @param array $args
     * @return bool
     */
    public function update(array $args = []): bool
    {
        return $this->repo->update($this->id(), $args);
    }
    
    public function toPlainObject() {
      if (array_key_exists(static::class, self::$exportPropertiesCache)) {
          $exportProperties = self::$exportPropertiesCache[static::class];
      } else {
          $reflection = new \ReflectionClass(static::class);
          $reflectionMethods = $reflection->getMethods();
          $exportProperties = [];
          foreach ($reflectionMethods as $method) {
              $doc = $method->getDocComment();
              if ($doc && false !== strpos($doc, '@export')) {
                  $exportProperties[] = $method->getName();
              }
          }
          self::$exportPropertiesCache[static::class] = $exportProperties;
      }
        
        $plainObject = [];
        foreach ($exportProperties as $exportProperty) {
            $exportable = true;
            $value = $this->{$exportProperty}();
            if ($value instanceof self) {
                $value = $value->toPlainObject();
            } else if ($value instanceof \App\Services\DomainCollection) {
                $value = $value->toPlainObject();
            } else if ($value instanceof Count) {
                $value = $value->asInt();
            } else if ($value instanceof Flag) {
                $value = $value->asBoolean();
            } else if (is_object($value) && method_exists($value, '__toString')) {
                $value = $value->__toString();
            } else if (is_scalar($value) || is_null($value)) {
                // do nothing
            } else {
                $exportable = false;
            }
            
            if ($exportable) {
                $plainObject[$exportProperty] = $value;
            }
        }
        
        return $plainObject;
    }
}
