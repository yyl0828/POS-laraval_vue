<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <script src="../../../public/js/jquery-3.2.1.js"></script>
    <script src="https://unpkg.com/vue"></script>
    <style>
        #usertable {
            border-bottom: 1px solid white;
            border-right: 1px solid white;
            color: whitesmoke;
        }

        #usertable td {
            border-left: 1px solid white;
            border-top: 1px solid white;
            text-align: center;
            color: whitesmoke;
            padding: 5px 15px;
            height: 30px;
        }

        .tagA {
            cursor: pointer;
            text-decoration: underline;
            margin-left: 10px;
        }

        [v-cloak] {
            display: none;
        }

        input {
            padding: 5px 10px;
        }

        thead {
            background: #b4b472;
        }
    </style>
<body style="background: #77b41d">
<h1>
    {{$user}}
</h1>
<div align="center" id="pageCon" v-cloak>
    @verbatim
        <table id="usertable">
            <thead>
            <tr>
                <td>id</td>
                <td width="200px">firstname</td>
                <td width="200px">lastname</td>
                <td width="200px">email</td>
                <td>操作</td>
            </tr>
            </thead>
            <tbody>

            <tr v-for="li in userlist">
                <td>{{li.id}}</td>
                <td>
                    <span v-if="!li.edit">{{li.firstname}}</span>
                    <input v-if="li.edit" type="text" v-model="li.firstname">
                </td>
                <td>
                    <span v-if="!li.edit">{{li.lastname}}</span>
                    <input v-if="li.edit" type="text" v-model="li.lastname">
                </td>
                <td>
                    <span v-if="!li.edit">{{li.email}}</span>
                    <input v-if="li.edit" type="text" v-model="li.email">
                </td>
                <td>
                    <a v-if="!li.edit" class="tagA" @click="editUser(li.id)">修改</a>
                    <a v-if="li.edit" class="tagA" @click="saveUser(li.id)">保存</a>
                    <a class="tagA" @click="deleteUser(li.id)">删除</a>
                </td>
            </tr>
            </tbody>
        </table>
    @endverbatim
</div>


<script>
    $(function () {
        var app = new Vue({
            el: '#pageCon',
            data: {
                userlist: ''
            },
            mounted: function () {
                $.getJSON('/Laravel_site/public/index.php/user/userList', function (data) {
                    if (data.result) {

                        data.data.forEach(function (item) {
                            item.edit = false;
                        });
                        app.userlist = data.data;
                    }
                });
            },
            methods: {
                editUser: function (id) {
                    app.userlist.forEach(function (item) {
                        if (item.id == id) {
                            item.edit = true;
                        }
                    })
                },
                saveUser: function (id) {
                    app.userlist.forEach(function (item) {
                        if (item.id == id) {
                            item.edit = false;
                            if (item.firstname.trim() == '' || item.lastname.trim() == '' || item.email.trim() == '') {
                                alert('参数不能为空');
                                return
                            }
                            $.post('/Laravel_site/public/index.php/user/editUser', {
                                id: item.id,
                                firstname: item.firstname,
                                lastname: item.lastname,
                                email: item.email
                            }, function (data) {
                                if (!data.result) {
                                    console.log('接口出错');
                                }
                            }, 'json');
                        }
                    });

                },
                deleteUser: function (id) {
                    $.post('/Laravel_site/public/index.php/user/deleteUser', {id: id}, function (data) {
                        if (data.result) {
                            for (var i = 0; i < app.userlist.length; i++) {
                                if (app.userlist[i].id == id) {
                                    app.userlist.splice(i, 1);
                                    alert('删除成功!');
                                }
                            }
                        }
                    }, 'json');

                }
            }
        });
    })

</script>
</body>
</html>