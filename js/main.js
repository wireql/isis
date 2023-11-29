$(document).ready(function () {
    let tableName = $('#tablename').text();
    let matches = tableName.match(/"([^"]+)"/);
    let table = matches ? matches[1] : null;
    table = table.toLowerCase();

    let edit = [];
    let data = {};

    $('[name="delete"]').on('click', function () {
        let id = $(this).attr('id');

        let a = confirm("Вы действительно хотите удалить запись?");
        
        if(a) {
            $.ajax({
                url: '/datas?table='+table,
                type: 'POST',
                data: {formName: 'delete', id: id},
                success: function(response) {
                    window.location.reload();
                },
                error: function(error) {
                    console.error('Ошибка при выполнении запроса: ' + error);
                }
            });
        }
    });

    $('[name="edit"]').on('click', function () {
        let id = $(this).attr('id');
        console.log(id);

        if (edit.includes(id)) {
            $('td[id="' + id + '"]').each(function () {
                let key = $(this).attr('name');
                let content = $(this).find('input').val();

                if($(this).attr('a') == 'select') { 
                    let id = $('[name="select"]').val();

                    $(this).html(id)
                    data[key] = id;
                }else {
                    data[key] = content;
                }
                $(this).html(content);
            });       
            
            console.log(data);
            $(this).html('<i class="material-icons">edit</i>'); 
            
            console.log(id);
            let index = edit.indexOf(id);

            if (index !== -1)
                edit.splice(index, 1);

            $.ajax({
                url: '/datas?table='+table,
                type: 'POST',
                data: {formName: 'update', id: $(this).attr('id'), data: data},
                success: function(response) {
                    console.log(response);
                },
                error: function(error) {
                    console.error('Ошибка при выполнении запроса: ' + error);
                }
            });
        } else {
            $('td[id="' + id + '"]').each(function () {
                if($(this).attr('a') == 'select') { 
                    $(this).each(function() {
                        const nname = $(this).attr('name');
                        $.ajax({
                            url: '/datas?table='+table,
                            type: 'POST',
                            data: {formName: 'getProductId'},
                            success: function(response) {
                                
                                let parse = JSON.parse(response);
                                let selectOptions = '';

                                if(parse['data']) {
                                    if(nname === 'order_id') {
                                        parse = parse['data'];

                                        for (let i = 0; i < parse.length; i++) {
                                            if(parse[i].type) selectOptions += `<option value="${parse[i].id}">${parse[i].id}: ${parse[i].type}</option>`;
                                            $('td[a="select"][name="order_id"][id="'+id+'"]').html('<select name="select" style="display: block;">'+selectOptions+'</select>');
                                        }
                                    }else if(nname === 'product_id') {
                                        parse = parse['data2'];

                                        for (let i = 0; i < parse.length; i++) {
                                            if(parse[i].product_name) selectOptions += `<option value="${parse[i].id}">${parse[i].id}: ${parse[i].product_name}</option>`;
                                        }
                                        $('td[a="select"][name="product_id"][id="'+id+'"]').html('<select name="select" style="display: block;">'+selectOptions+'</select>');
                                    }
                                }else {
                                    for (let i = 0; i < parse.length; i++) {
                                        if(parse[i].product_name) selectOptions += `<option value="${parse[i].id}">${parse[i].id}: ${parse[i].product_name}</option>`;
                                        if(parse[i].name) selectOptions += `<option value="${parse[i].id}">${parse[i].id}: ${parse[i].name}</option>`;
    
                                        if(parse[i].type) selectOptions += `<option value="${parse[i].id}">${parse[i].id}: ${parse[i].type}</option>`;
                                    }
        
                                    $('td[a="select"][name="product_id"][id="'+id+'"]').html('<select name="select" style="display: block;">'+selectOptions+'</select>');
                                    $('td[a="select"][name="employee_id"][id="'+id+'"]').html('<select name="select" style="display: block;">'+selectOptions+'</select>');
    
                                    $('td[a="select"][name="order_id"][id="'+id+'"]').html('<select name="select" style="display: block;">'+selectOptions+'</select>');
                                }
                            },
                            error: function(error) {
                                console.error('Ошибка при выполнении запроса: ' + error);
                            }
                        });
                    })
                }else {
                    let content = $(this).text();
    
                    $(this).html('<input type="text" class="edit-input" value="' + content + '">');
                }
            });       
            
            $(this).html('<i class="material-icons">done</i>'); 
            
            edit.push(id);
        }
    });

});