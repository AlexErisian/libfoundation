@php
    /** @var \App\Models\User $user */
    /** @var array $roleOptions */
    /** @var array $readercardOptions */
@endphp
<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white">Редагування запису: користувач</h5>
    </div>
    <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active"
                   href="#mainData"
                   aria-controls="mainData"
                   role="tab"
                   data-toggle="tab">Основні дані</a>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                   href="#addData"
                   aria-controls="addData"
                   role="tab"
                   data-toggle="tab">Інші дані</a>
            </li>
        </ul>
        <br>
        <div class="tab-content">
            <div id="mainData" class="tab-pane active" role="tabpanel">
                <div class="form-group">
                    <label for="name">Ім'я</label>
                    <input class="form-control"
                           type="text"
                           id="name"
                           name="name"
                           required
                           value="{{ old('name', $user->name) }}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control"
                           type="text"
                           id="email"
                           readonly
                           value="{{ $user->email }}">
                </div>
                <div class="form-group">
                    <label for="role_id">Роль користувача у системі</label>
                    <select class="form-control"
                            id="role_id"
                            name="role_id">
                        <option selected value="{{ $user->role_id }}">
                            {{ $user->role_id.'. '.$user->role->name }}
                        </option>
                        @foreach($roleOptions as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->id.'. '.$role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="readercard_id">Читацький квиток користувача</label>
                    <select class="form-control"
                            id="readercard_id"
                            name="readercard_id">
                        <option selected value="{{ $user->readercard_id }}">
                            {{ $user->readercard_id.'. '.$user->readercard->code }}
                        </option>
                        @foreach($readercardOptions as $readercard)
                            <option value="{{ $readercard->id }}">
                                {{ $readercard->id.'. '.$readercard->code }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <fieldset class="form-group">
                    <legend class="col-form-label">Заблоковано</legend>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="is_banned"
                               id="is_banned1"
                               value="1"
                               @if(old('is_banned', $user->is_banned)) checked @endif>
                        <label class="form-check-label"
                               for="is_banned1">Так</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="radio"
                               name="is_banned"
                               id="is_banned0"
                               value="0"
                               @if(!old('is_banned', $user->is_banned)) checked @endif>
                        <label class="form-check-label"
                               for="is_banned0">Ні</label>
                    </div>
                </fieldset>
            </div>
            <div id="addData" class="tab-pane" role="tabpanel">
                <div class="form-group">
                    <label for="phone">Номер телефону</label>
                    <input class="form-control"
                           type="tel"
                           id="phone"
                           name="phone"
                           value="{{ old('phone', $user->phone) }}">
                </div>
                <div class="form-group">
                    <label for="notes">Примітки</label>
                    <textarea class="form-control"
                              id="notes"
                              name="notes"
                              rows="3">{{ old('notes', $user->notes) }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">Зберегти</button>
    </div>
</div>
