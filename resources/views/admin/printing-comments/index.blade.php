@extends('layouts.app')

@section('content')
    <div class="col">
        @include('messages.result')
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="text-white">Усі записи: коментарі до видань</h5>
                <a class="btn btn-secondary d-print-none"
                   href="{{ route('admin.printing-comments.create') }}">
                    Створити новий
                </a>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <td>Ідентифікатор</td>
                        <td>До якого видання</td>
                        <td>Користувач-автор</td>
                        <td class="d-none d-md-table-cell">Текст</td>
                        <td class="d-none d-md-table-cell">Змінено</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commentsPagination as $comment)
                        @php /** @var \App\Models\PrintingComment $comment*/ @endphp
                        <tr>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printing-comments.edit', $comment->id) }}">
                                    {{ $comment->id }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.printings.edit', $comment->printing->id) }}">
                                    {{ $comment->printing->title }}
                                </a>
                            </td>
                            <td>
                                <a class="card-link"
                                   href="{{ route('admin.users.edit', $comment->user->id) }}">
                                    {{ $comment->user->name }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $comment->text }}
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $comment->updated_at }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if($commentsPagination->total() > $commentsPagination->count())
                        {{ $commentsPagination->links() }}
                @endif
                <button class="btn btn-outline-primary float-right"
                        onclick="window.print();">
                    Надрукувати звіт
                </button>
            </div>
        </div>
    </div>
@endsection
