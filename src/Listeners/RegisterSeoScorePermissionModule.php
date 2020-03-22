<?php

namespace Quill\SeoScore\Listeners;

class RegisterSeoScorePermissionModule
{ 
    public function handle()
    {
        return [
            'SeoScore' => [
                'view'
            ]
        ];
    }
}
