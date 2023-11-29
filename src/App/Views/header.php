<ul id="dropdown1" class="dropdown-content">
    <li><a href="/datas?table=products">products</a></li>
    <li><a href="/datas?table=employees">employees</a></li>
    <li><a href="/datas?table=orders">orders</a></li>
    <li><a href="/datas?table=action_order">action_order</a></li>
    <li><a href="/datas?table=connect_employees">connect_employees</a></li>
    <li><a href="/datas?table=users">users</a></li>
</ul>
<nav class="blue-grey darken-3">
    <div class="container">
        <div class="nav-wrapper">
            <a href="/" class="brand-logo"><i class="material-icons">devices_other</i>Ремонт бытовой техники</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php 
                    if(isset($_SESSION['username'])) {
                        if($_SESSION['role'] != 0){
                            ?>
                                <li><a href="/index">Отчет</a></li>    
                            <?
                        }
                            if($_SESSION['role'] == 2){
                                ?>
                                    <!-- Dropdown Trigger -->
                                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Данные<i class="material-icons right">arrow_drop_down</i></a></li>
                                <?
                            }
                        ?>
                        <li><a href="/logout"><i class="material-icons right">exit_to_app</i>Выйти</a></li>
                        <?
                    }else {
                        ?>
                            <li><a href="/login"><i class="material-icons right">person</i>Войти</a></li>    
                        <?
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>