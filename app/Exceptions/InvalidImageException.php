<?php

namespace App\Exceptions;

use Exception;

class InvalidImageException extends Exception {

    public function report() {

        \Log::debug('Falha ao salvar a imagem');
    }
}
