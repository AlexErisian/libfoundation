@extends('layouts.app')

@section('content')
    <div class="col">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: зв'язки "видання-жанр"</h5>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>Ідентифікатор видання</td>
                        <td>Ідентифікатор жанру</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($linksPagination as $link)
                        <tr>
                            <td>{{ $link->id }}</td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $link->printing_id) }}">
                                    {{ $link->printing_id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-genres.edit', $link->printing_genre_id) }}">
                                    {{ $link->printing_genre_id }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($linksPagination->total() > $linksPagination->count())
                    {{ $linksPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
