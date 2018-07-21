<?php

if (! function_exists('flash')) {
    /**
     * Store it to the session as flash data.
     *
     * @param  string $msg
     * @param  string $state
     * @param  string $name
     * @return void
     *
     * @author Kuniyasu Wada
     */
    function flash(string $msg = 'message', string $state = 'success', string $name = 'alerts')
    {
        session()->flash($name);
        session()->push(sprintf('%s.%s', $name, $state), $msg);
    }
}
