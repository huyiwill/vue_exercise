<template>
  <div id="box">
    <el-button @click="get">get按钮</el-button>
    <div>{{myMessage}}</div>
    <hr>
    <el-button type="primary">button</el-button>
    <el-radio class="radio" v-model="radio" label="1">backUP</el-radio>
    <el-radio class="radio" v-model="radio" label="2">backUP</el-radio>

    <!--日历-->
    <el-date-picker v-model="value1" type="datetime" placeholder="选择日期">
    </el-date-picker>

    <!--  rate -->
    <el-rate v-model="val"></el-rate>

    <!-- 分页 -->
    <el-pagination :total="1000"></el-pagination>
    <hr>
    <!-- 选项卡 -->
    <el-tabs type="card">
      <el-tab-pane label="用户管理">
        <el-badge :value="12" class="item" style="margin-top: 10px;">
          <el-button size="small">评论</el-button>
        </el-badge>
      </el-tab-pane>


      <el-tab-pane label="配置管理" name="second">配置管理
        <el-switch v-model="bSign" off-text="3" on-text="2" active-color="#13ce66" inactive-color="#ff4949">
        </el-switch>
      </el-tab-pane>


      <el-tab-pane label="角色管理" name="third">角色管理
        <el-table :data="tableData" style="width: 100%">
          <el-table-column
            prop="date"
            label="日期"
            width="180">
          </el-table-column>
          <el-table-column
            prop="name"
            label="姓名"
            width="180">
          </el-table-column>
          <el-table-column
            prop="address"
            label="地址">
          </el-table-column>
        </el-table>
      </el-tab-pane>
      <el-tab-pane label="定时任务补偿" name="fourth">定时任务补偿</el-tab-pane>

    </el-tabs>

    <!--  button  子组件将事件返回给父组件 -->
    <myButton @click.native="get"></myButton>
  </div>
</template>

<script>
  import axios from 'axios'
  import myButton from './Button.vue'

  export default {
    name      : "Elements",
    components: {
      myButton
    },
    data(){
      return {
        myMessage: '默认数据',
        value1   : '',
        bSign    : true,
        val      : 3,
        radio    : 1,
        tableData: [
          {
            date   : '2016-05-02',
            name   : '王小虎',
            address: '上海'
          }, {
            date   : '2016-05-04',
            name   : '王小虎',
            address: '北京'
          }, {
            date   : '2016-05-01',
            name   : '王小虎',
            address: '上海'
          }
        ],
      }
    },
    mounted(){  //钩子函数
      this.get();
    },
    methods   : {
      get: function(){
        axios.get('https://api.github.com/users/itstrive').then(function(res){
          console.log(res.data.login);
          this.myMessage = res.data.login;
        }.bind(this)).catch(function(err){  //then逅直接绑定  bind(this)
          console.log(err);
        })
      },
    },
  }
</script>

<style scoped>

</style>
