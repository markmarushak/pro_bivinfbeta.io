@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-sm-12">
                <header>
                    <h3>Контекст для групп</h3>
                </header>
            </div>

            <div class="col-sm-12">

                <div class="main">
                    <form action="#" id="add_content">

                        <div class="row">

                            <div class="form-group col-sm-3">
                                <label>
                                <span>
                                    выберите группу для заполнения
                                </span>
                                    <select name="group_id" class="form-control group_id" required>
                                        <option value="-">выберите</option>
                                        @foreach($groups->where('main_id',0)->get()->toArray() as $group)
                                            <optgroup label="{{ $group['name'] }}">
                                                @foreach($groups->getparent($group['id']) as $parent)
                                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="form-group col-sm-2">
                                <label>
                                    <span>
                                        стоимость услуги
                                    </span>
                                    <input type="number" name="price" class="form-control price" required>
                                </label>
                            </div>

                            <div class="form-group col-sm-2">
                                <label>
                                    <span>
                                        сроки выполнения
                                    </span>
                                    <input type="text" name="time" class="form-control time" required>
                                </label>
                            </div>

                            <div class="form-group col-sm-2">
                                <label>
                                    <span>
                                        Регион исполнения
                                    </span>
                                    <input type="text" name="region" class="form-control region" required>
                                </label>
                            </div>

                            <div class="form-group col-sm-3">
                                <label for="">
                                    <span>проверьте и сохраните информацию</span>
                                    <button class="btn btn-success btn-block">сохранить</button>
                                </label>
                            </div>

                            <div class="form-group col-sm-12">
                                <textarea name="text" id="" cols="30" rows="10" class="form-control text"></textarea>
                            </div>

                        </div>

                    </form>
                </div>

            </div>

            <hr>

            <div class="col-sm-12">

                <div class="notification">

                    <form action="#" id="add_section">

                        <div class="row">

                            <div class="form-group col-sm-4">

                                <label>
                                    <span>Введите дополнительную информацию:</span>
                                    <select name="section_id" id="dop" class="form-control section_id">
                                        <option value="-">Выберите секцию</option>
                                        <option value="1">Верхняя секция</option>
                                        <option value="2">Средня секция</option>
                                        <option value="3">Нижняя секция</option>
                                    </select>
                                </label>
                            </div>

                            <div class="form-group col-sm-4">
                                <label>
                                    <span>проверьте и сохраните информацию</span>
                                    <button class="btn btn-success btn-block">сохранить</button>
                                </label>
                            </div>


                            <div class="form-group col-sm-12">
                                <textarea name="text" cols="30" rows="10" class="form-control text"></textarea>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/admin_main.js') }}"></script>
@endsection