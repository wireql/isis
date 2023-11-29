<div class="container">
    <h4>Данные</h4>
    <div style="margin-top: 50px;">
    <h5 id="tablename">Таблица "<?php echo $data[0]; ?>"</h5>
    <form id="formCreateProducts" method="post" action="" class="col s12">


        <input type="hidden" name="formName" value="add">


        <div class="row">
            <div class="input-field col s12 m3">
                <input placeholder="Введите наименование Имя" type="text" class="validate" value="" max="12" min="1" name="name" required>
                <label for="name">Имя</label>
            </div>
            <div class="input-field col s12 m3">
                <input placeholder="Введите должность" type="text" class="validate" value="" name="post" required>
                <label for="post">Должность</label>
            </div>
            <button class="btn waves-effect waves-light" type="submit">
                Добавить
            </button>
        </div>
    </form>
    <table class="striped">
        <thead>
            <tr>
                <th>Имя</th>
                <th>Должность</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($data[1] as $value) {
                ?>
                    <tr>
                        <td name="name" id="<? echo $value['id'] ?>"><? echo $value['name'] ?></td>
                        <td name="post" id="<? echo $value['id'] ?>"><? echo $value['post'] ?></td>
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