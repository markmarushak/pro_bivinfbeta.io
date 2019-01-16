@extends('layouts.admin')


@section('content')


    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <div class="form-add-group">

                    <form action="#" id="add-main-groups">
                        <input type="hidden" name="main_id" value="0">
                        <div class="form-group ">
                            <label>
                                <span>Название группы</span>
                                <input type="text" name="name" class="form-control" required>
                            </label>
                        </div>

                        <button class="btn btn-success">добавить группу</button>

                    </form>

                </div>

            </div>

            <div class="col-sm-6">

                <div class="form-add-group">

                    <form action="#" id="add-sub-groups">

                        <div class="form-group">
                            <label>
                                <span>Выберите основную грппу: </span>
                                <select name="main_id" id="add-sub-main-group" class="form-control" required="true">
                                    <option value="-">Выберите</option>
                                </select>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>
                                <span>Название под-группы</span>
                                <input type="text" name="name" class="form-control" required>
                            </label>
                        </div>

                        <button class="btn btn-success">добавить под-группу</button>

                    </form>

                </div>

            </div>

            <div class="col-sm-6">
                <header>
                    Основные группы:
                </header>
                <div id="main-group">

                </div>

            </div>

            <div class="col-sm-6">
                <header>
                    Под-группы:
                </header>
                <div id="ch-group">

                </div>

            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ asset('js/add.js') }}"></script>
@endsection