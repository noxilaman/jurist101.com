<?php

/**
 * Created by Cristian.
 * Date: 11/09/16 09:26 PM.
 */

namespace Reliese\Coders\Model\Relations;

use Illuminate\Support\Str;

class HasOne extends HasOneOrMany
{
    /**
     * @return string
     */
    public function hint()
    {
        return $this->related->getQualifiedUserClassName() . '|null';
    }

    /**
     * @return string
     */
    public function name()
    {
        if ($this->parent->usesSnakeAttributes()) {
            return Str::snake($this->related->getClassName());
        }

        return Str::camel($this->related->getClassName());
    }

    /**
     * @return string
     */
    public function method()
    {
        return 'hasOne';
    }

    /**
     * @return string
     */
    public function returnType()
    {
        return \Illuminate\Database\Eloquent\Relations\HasOne::class;
    }
}
