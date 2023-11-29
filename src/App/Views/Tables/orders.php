


<div class="container">
    <h4>Данные</h4>

    <?php

    /*

        Все, что находится ниже (вывод Ремонт товаров в период, Ремонты сотрудника и Общая сумма производства в месяц) 
        - 
        выглядит очень даже не красиво (в плане кода), sorry :(

    */

    echo '<div class="row">';
    echo '<div class="col m4">';

    $start_date = '2023-09-26 10:10:10';
    $end_date = '2023-09-27 10:10:10';

    $repairs = R::find('orders', 'guarantee = 1 AND date_order BETWEEN :start AND :end', [
        ':start' => $start_date,
        ':end' => $end_date,
    ]);
    ?>
        <h5>Ремонт товаров произведенный в период с <? echo $start_date; ?> по <? echo $end_date; ?>:</h5>
    <?
    foreach ($repairs as $repair) {

        $item = R::load('orders', $repair['product_id']);
        $product = R::findOne('products', 'id = ?', [$repair['product_id']]);

        echo $product['product_name'] . " | Клиент: " . $repair['client_name'] . "</br>";
    }
    echo '</div>';
    echo '<div class="col m4">';

    $id = 3;
    $item = R::load('employees', $id);

    $repairs_count = R::count('action_order', 'employee_id = ?', [$id]);

    $res = R::find('action_order', 'employee_id = :id', [
        ':id' => $id
    ]);

    ?>
        <h5>Сотрудник: <? echo $item['name']; ?> произвел следующие ремонты:</h5>
    <?
    foreach ($res as $repair) {
        echo $repair['type'] . "</br>";
    }
    echo "<h5>Всего: ".$repairs_count." </h5>";
    echo '</div>';
    echo '<div class="col m4">';

    $selected_month = "2023-10";
    $start_date = "$selected_month-01";
    $end_date = date("Y-m-t", strtotime($start_date));

    $total_revenue = R::getCell('SELECT SUM(price_all) FROM action_order WHERE date_end_order BETWEEN ? AND ?', [$start_date, $end_date]);

    echo "<h5>Фирма произвела ремонт на сумму $total_revenue в месяц $selected_month.</h5>";

    echo '</div>';
    echo '</div>';

    R::close();
    ?>


    <h5 id="tablename">Таблица "orders"</h5>
    <form id="formCreateProducts" method="post" action="" class="col s12">

        <input type="hidden" name="formName" value="add">

        <div class="row">
            <div class="input-field col s12 m3">
                <input placeholder="Введите имя клиента" type="text" class="validate" value="" name="client_name" >
                <label for="client_name">Имя клиента</label>
            </div>
            <div class="input-field col s12 m3">
                <select name="product_id">
                <?php 

                    $r = R::getAll('SELECT * FROM products');

                    foreach ($r as $value) {
                        ?>
                            <option value="<? echo $value['id'] ?>"><? echo $value['id'] . ". " . $value['product_name']?></option>
                        <?
                    }
                ?>
                </select>
                <label>ID Товара</label>
            </div>
            <div class="input-field col s12 m3">
                <label>
                    <input type="checkbox" id="guarantee" name="guarantee"/>
                    <span>Гарантия</span>
                </label>
            </div>
            <div class="input-field col s12 m3">
                <input placeholder="yyyy-mm-dd hh:mm:ss" type="text" class="validate" value="" name="date_order">
                <label for="date_order">Дата заказа</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">
                Добавить
            </button>
        </div>
    </form>
    <table class="striped">
        <thead>
            <tr>
                <th>Имя клиента</th>
                <th>ID Товара</th>
                <th>Гарантия</th>
                <th>Дата заказа</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($data[1] as $value) {
                ?>
                    <tr>
                        <td name="client_name" id="<? echo $value['id'] ?>"><? echo $value['client_name'] ?></td>
                        <td a="select" name="product_id" id="<? echo $value['id'] ?>"><? echo $value['product_id'] ?></td>
                        <td name="guarantee" id="<? echo $value['id'] ?>"><? echo $value['guarantee'] ?></td>
                        <td name="date_order" id="<? echo $value['id'] ?>"><? echo $value['date_order'] ?></td>
                        <td>
                            <form id="actionForm">
                                <button class="btn-floating btn-small waves-effect waves-light red" type="button" name="delete" id="<? echo $value['id'] ?>"><i class="material-icons">delete</i></button>
                                <button class="btn-floating btn-small waves-effect waves-light blue" type="button" name="edit" id="<? echo $value['id'] ?>"><i class="material-icons">edit</i></button>
                            </form>
                        </td>
                    </tr>
                <?
            }

            ?>
        </tbody>
    </table>


    </div>
</div>