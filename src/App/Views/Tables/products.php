<div class="container">
    <h4>Данные</h4>
    <div style="margin-top: 50px;">
    <h5 id="tablename">Таблица "<?php echo $data[0]; ?>"</h5>

    
        <form id="formCreateProducts" method="post" action="" class="col s12">


            <input type="hidden" name="formName" value="add">


            <div class="row">
                <div class="input-field col s12 m3">
                    <input placeholder="Введите наименование товара" type="text" class="validate" value="" max="12" min="1" name="product_name" required>
                    <label for="product_name">Наименование товара</label>
                </div>
                <div class="input-field col s12 m3">
                    <input placeholder="Введите фирму" type="text" class="validate" value="" name="company" required>
                    <label for="company">Фирма</label>
                </div>

                <div class="input-field col s12 m3">
                    <input placeholder="Введите модель" id="model" type="text" class="validate" value="" name="model" required>
                    <label for="model">Модель</label>
                </div>
                
                <div class="input-field col s12 m3">
                    <input placeholder="Введите характеристики" id="characteristics" type="text" class="validate" value="" name="characteristics">
                    <label for="characteristics">Характеристики</label>
                </div>

                <div class="input-field col s12 m3">
                <label>
                    <input type="checkbox" id="guarantee" name="guarantee"/>
                    <span>Гарантия</span>
                </label>
                </div>
                <div class="input-field col s12 m3">
                    <input placeholder="Введите модель" id="img" type="text" class="validate" value="" name="img">
                    <label for="img">Картинка</label>
                </div>
                <button class="btn waves-effect waves-light" type="submit">
                    Добавить новый товар
                </button>
            </div>
        </form>

        
        <table class="striped">
            <thead>
                <tr>
                    <th>Наименование товара</th>
                    <th>Фирма</th>
                    <th>Модель</th>
                    <th>Характеристики</th>
                    <th>Гарантия</th>
                    <th>Картинка</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                foreach ($data[1] as $value) {
                    ?>
                        <tr>
                            <td name="product_name" id="<? echo $value['id'] ?>"><? echo $value['product_name'] ?></td>
                            <td name="company" id="<? echo $value['id'] ?>"><? echo $value['company'] ?></td>
                            <td name="model" id="<? echo $value['id'] ?>"><? echo $value['model'] ?></td>
                            <td name="characteristics" id="<? echo $value['id'] ?>"><? echo $value['characteristics'] ?></td>
                            <td name="guarantee" id="<? echo $value['id'] ?>"><? echo $value['guarantee'] ?></td>
                            <td name="img" id="<? echo $value['id'] ?>"><? echo $value['img'] ?></td>
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