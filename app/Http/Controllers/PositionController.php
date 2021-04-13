<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PositionController extends Controller
{
    protected const COLUMN = 'position';

    public function menu(Menu $menu, int $position)
    {
        $result = [
            'success' => true,
            'url' => route('admin.menu.index')
        ];

        try {
            DB::beginTransaction();

            $secondModel = $this->getSwitchModel($menu, $position);

            $this->switchPositions($menu, $secondModel);

            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();

            $result = [
                'success' => false,
                'message' => $err->getMessage()
            ];
        }

        return response()->json($result);
    }

    public function category(Category $category, int $position)
    {
        $result = [
            'success' => true,
            'url' => route('admin.category.index')
        ];

        try {
            DB::beginTransaction();

            $secondModel = $this->getSwitchModel($category, $position);

            $this->switchPositions($category, $secondModel);

            DB::commit();
        } catch (\Exception $err) {
            DB::rollBack();

            $result = [
                'success' => false,
                'message' => $err->getMessage()
            ];
        }

        return response()->json($result);
    }

    protected function getSwitchModel(Model $model, int $position): Model
    {
        if (abs($position) != 1) {
            throw new \Exception('Wrong position');
        }

        $newPosition = $model->position + $position;

        if ($model->position == $newPosition) {
            throw new \Exception('Positions are equal');
        }

        $class = get_class($model);

        $switchModel = $class::where(self::COLUMN, $newPosition)->first();

        if (is_null($switchModel)) {
            throw new \Exception('Not found switch model');
        }

        return $switchModel;
    }

    protected function switchPositions(Model $modelOne, Model $modelTwo)
    {
        $temp = $modelOne->position;

        $modelOne->update([
            self::COLUMN => $modelTwo->position
        ]);

        $modelTwo->update([
            self::COLUMN => $temp
        ]);
    }

    public function recalculate(string $model)
    {
        if (!in_array($model, [Menu::class, Category::class])) {
            throw new \Exception('Wrong model');
        }

        $items = $model::orderBy(self::COLUMN, 'ASC')->get();
        $iterator = 1;

        foreach ($items as $item) {
            $item->update([
                self::COLUMN => $iterator++
            ]);
        }
    }
}
