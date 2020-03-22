<?php

namespace Quill\SeoScore\Resource;

use Quill\Html\Fields\ID;
use Quill\SeoScore\Models\SeoScore;
use Vellum\Contracts\Formable;

class SeoScoreResource extends SeoScore implements Formable
{
    public function fields()
    {
        return [
            ID::make()->sortable()->searchable(),
        ];
    }

    public function filters()
    {
        return [
            //
        ];
    }

    public function actions()
    {
        return [
            new \Vellum\Actions\EditAction,
            new \Vellum\Actions\ViewAction,
            new \Vellum\Actions\DeleteAction,
        ];
    }

    public function excludedFields()
    {
    	return [
    		//
    	];
    }
}
