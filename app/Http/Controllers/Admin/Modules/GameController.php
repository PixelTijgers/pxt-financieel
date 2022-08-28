<?php

// Controller namespacing.
namespace App\Http\Controllers\Admin\Modules;
use App\Http\Controllers\Controller;

// Facades.
use Yajra\Datatables\Datatables;
use Yajra\DataTables\Html\Builder;

// Models.
use App\Models\Game;

// Request
use App\Http\Requests\GameRequest;

// Traits
use App\Traits\DataTableActionsTrait;
use App\Traits\HasRightsTrait;

// Carbon
use Carbon\Carbon;

class GameController extends Controller
{
    /**
     * Traits
     *
     */
    use DataTableActionsTrait,
        HasRightsTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Builder $builder)
    {
        // Init datatables.
        if (request()->ajax()) {
            return DataTables::of(Game::query()->with(['teamOne', 'teamTwo']))
            ->editColumn('game_date', function(Game $game) {
                return Carbon::parse($game->game_date)->formatLocalized('%d-%m-%Y om %H:%M');
            })
            ->addColumn('action', function (Game $game) {
                return
                    '<div class="d-flex">' .
                        $this->setAction('game.index', $game, 'view', 'games', false) .
                        $this->setAction('game.edit', $game, 'update', 'games') .
                        $this->setAction('game.destroy', $game, 'destroy', 'games') .
                    '</div>';
            })
            ->make(true);
        }

        // Set values.
        $html = $builder
                    ->addColumn([
                        'title' => __('Home'),
                        'data' => 'team_one.name'
                    ])
                    ->addColumn([
                        'title' => __('Away'),
                        'data' => 'team_two.name'
                    ])
                    ->addColumn([
                        'title' => __('Field'),
                        'data' => 'field'
                    ])
                    ->addColumn([
                        'title' => __('Gamedate'),
                        'data' => 'game_date'
                    ])
                    ->addAction([
                        'title' => __('Actions'),
                        'class' => 'actionHandler'
                    ])
                    ->parameters([
                        'order' =>
                            [3,'asc'],
                            [2,'asc']
                    ]);

        // Init view.
        return view('admin.modules.game.index', compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Init view.
        return view('admin.modules.game.createEdit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameRequest $request)
    {
        // Get games.
        $getGames = Game::where('field', $request->field)->where('game_date', $request->game_date)->get();

        // Return to page when field and time are already taken.
        if(!$getGames->isEmpty())
        {
            // Return back with message.
            return redirect()->back()->with([
                'type' => 'danger',
                'message' => 'Er is al een wedstrijd op dit veld met ingepland met deze tijd.'
            ])->withInput();
        }

        // Post data to database.
        Game::Create($request->validated());

        // Return back with message.
        return redirect()->route('game.index')->with([
                'type' => 'success',
                'message' => __('Alert Add')
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        // Init view.
        return view('admin.modules.game.createEdit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(GameRequest $request, Game $game)
    {
        // Get games.
        $getGames = Game::where('field', $request->field)->where('game_date', $request->game_date)->get();

        // Return to page when field and time are already taken.
        if(!$getGames->isEmpty())
        {
            // Return back with message.
            return redirect()->back()->withInput($request)->with([
                'type' => 'danger',
                'message' => 'Er is al een wedstrijd op dit veld met ingepland met deze tijd.'
            ]);
        }

        // Set data to save into database.
        $game->update($request->validated());

        // Save data.
        $game->save();

        // Return back with message.
        return redirect()->route('game.index')->with([
                'type' => 'success',
                'message' => __('Alert Edit')
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        // Delete the model.
        $game->delete();

        // Return back with message.
        return redirect()->back()->with([
            'type' => 'success',
            'message' => __('Alert Delete')
        ]);
    }
}
