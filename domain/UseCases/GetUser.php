<?php
declare(strict_types=1);

namespace Domain\UseCases;

use Domain\Traits\Transactional;

class GetUser
{
    use Transactional;

    /**
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     *
     */
    public function excute()
    {
        try {
            $this->transaction(function () {
                auth()->user()->update([
                    'name' => 'test1',// ok
                ]);

                auth()->user()->update([
                    'name' => null,// error
                ]);
            });
            $msg = 'ok';
        } catch (\Exception $e) {
            $msg = $e;
        } finally {
            return $msg;
        }

    }

}
