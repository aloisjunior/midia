<template>
  <!--<aside class="aside-menu px-2">-->
    <!---->
  <!--</aside>-->

  <aside class="aside-menu">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab"><i class="icon-list"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages" role="tab"><i class="icon-speech"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#settings" role="tab"><i class="icon-settings"></i></a>
      </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active p-1" id="settings" role="tabpanel">
        <h6>Settings</h6>

        <div class="aside-options">
          <div class="clearfix mt-2">
            <small><b>Monitoramento Facebook</b>
            </small>
            <label class="switch switch-text switch-pill switch-success switch-sm float-right">
              <input type="checkbox" class="switch-input" v-model="show" @change="EnviarGrafico()">
              <span class="switch-label" data-on="On" data-off="Off"></span>
              <span class="switch-handle"></span>
            </label>
          </div>
          <div>
            <small class="text-muted">Indique se deseja monitorar o Facebook na página inicial da Dashboard.</small>
          </div>
        </div>

      </div>
    </div>

  </aside>
</template>

<script>
import bus from '../../events/bus'


export default {
//  name: 'aside'
    data () {
        return {
            name: 'aton-menu-dir',
            show: true,
                    }
    },
    methods:{
        EnviarGrafico: function(){
//            this.show = !this.show;
            bus.$emit('mudarshowface', this.show);
        }
    },
    components:{

    }
}
</script>


<!--<div class="aside-options">-->
  <!--<div class="clearfix mt-1">-->
    <!--<small><b>Option 3</b>-->
    <!--</small>-->
    <!--<label class="switch switch-text switch-pill switch-success switch-sm float-right">-->
      <!--<input type="checkbox" class="switch-input">-->
      <!--<span class="switch-label" data-on="On" data-off="Off"></span>-->
      <!--<span class="switch-handle"></span>-->
    <!--</label>-->
  <!--</div>-->
<!--</div>-->

<!--<hr>-->
<!--<h6>System Utilization</h6>-->

<!--<div class="text-uppercase mb-q mt-2">-->
  <!--<small><b>CPU Usage</b>-->
  <!--</small>-->
<!--</div>-->
<!--<div class="progress progress-xs">-->
  <!--<div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--</div>-->
<!--<small class="text-muted">348 Processes. 1/4 Cores.</small>-->

<!--<div class="text-uppercase mb-q mt-h">-->
  <!--<small><b>Memory Usage</b>-->
  <!--</small>-->
<!--</div>-->
<!--<div class="progress progress-xs">-->
  <!--<div class="progress-bar bg-warning" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--</div>-->
<!--<small class="text-muted">11444GB/16384MB</small>-->

<!--<div class="text-uppercase mb-q mt-h">-->
  <!--<small><b>SSD 1 Usage</b>-->
  <!--</small>-->
<!--</div>-->
<!--<div class="progress progress-xs">-->
  <!--<div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--</div>-->
<!--<small class="text-muted">243GB/256GB</small>-->

<!--<div class="text-uppercase mb-q mt-h">-->
  <!--<small><b>SSD 2 Usage</b>-->
  <!--</small>-->
<!--</div>-->
<!--<div class="progress progress-xs">-->
  <!--<div class="progress-bar bg-success" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>-->
<!--</div>-->
<!--<small class="text-muted">25GB/256GB</small>-->