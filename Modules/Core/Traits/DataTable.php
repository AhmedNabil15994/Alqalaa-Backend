<?php

namespace Modules\Core\Traits;

trait DataTable
{
    // DataTable Methods
    public static function drawTable($request, $query)
    {
        list($output, $models) = self::getModel($request, $query);

        $models = $models
            ->skip($request->input('start'))
            ->take($request->input('length', 25));

        $output['data'] = $models->get();
        return $output;
    }
    // DataTable Methods
    public static function drawPrintWithoutData($request, $query)
    {
        $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
        $sort['dir'] = $request->input('order.0.dir');

        return $query->orderBy($sort['col'] ?? 'id', $sort['dir'] ?? 'desc')->get();
    }
    
    // DataTable Methods
    public static function drawPrint($request, $query)
    {
        list($output, $models) = self::getModel($request, $query);

        $output['data'] = $models->get();
        return $output;
    }

    /**
     * @param $request
     * @param $query
     * @return array
     */
    public static function getModel($request, $query): array
    {
        $sort['col'] = $request->input('columns.' . $request->input('order.0.column') . '.data');
        $sort['dir'] = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $counter = $query->count();

        $output['recordsTotal'] = $counter;
        $output['recordsFiltered'] = $counter;
        $output['draw'] = intval($request->input('draw'));

        // Get Data
        $models = $query->orderBy($sort['col'] ?? 'id', $sort['dir'] ?? 'desc');

        return array($output, $models);
    }
}
