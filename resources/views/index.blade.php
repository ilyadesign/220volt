<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>220volt</title>
    </head>
    <body>
        <div id="container">
            <br />
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                 <span style="color:red;">{{ $error }}</span><br />
                @endforeach
                <hr />
            @endif

            <form action="{{ route('vendorCreate') }}" method="POST">
                <input type="text" name="name" value="" placeholder="Наименование производителя">
                <input type="submit" value="Добавить производителя">
                {{ csrf_field() }}
            </form>

            <hr />

            <table style="text-align:left">
                <tr>
                    <td>ID:</td>
                    <td>Производитель:</td>
                </tr>
                @foreach ($vendors as $vendor)       
                    <tr>
                        <td>{{ $vendor->id }}</td>
                        <td>{{ $vendor->name }}</td>
                        <td>
                            <form action="{{ route('vendorDelete',['vendor_id'=>$vendor->id]) }}" method="POST">
                                <input type="submit" value="Удалить производителя">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>
                @endforeach     
            </table>

            <hr />

            <form action="{{ route('goodsCreate') }}" method="POST">
                <input type="text" name="name" value="" placeholder="Наименование товара"><br>
                <input type="text" name="price" value="" placeholder="Цена товара"><br>
                <input type="text" name="description" value="" placeholder="Описание товара"><br>
                <select name="vendor_id">
                    <option disabled selected value="">Выберите производителя</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
                <input type="submit" value="Добавить товар">
                {{ csrf_field() }}
            </form>

             <hr />

             <table style="text-align:left">
                <tr>
                    <td>ID:</td>
                    <td>Товар:</td>
                </tr>
                @foreach ($goods as $item)       
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <form action="{{ route('goodsDelete',['item_id'=>$item->id]) }}" method="POST">
                                <input type="submit" value="Удалить товар">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                            </form>
                        </td>
                    </tr>     
                @endforeach
            </table>

            <hr />

        </div>
    </body>
</html>
