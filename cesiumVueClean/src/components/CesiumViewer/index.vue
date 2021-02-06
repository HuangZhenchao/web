<!--
 * @Description: 
 * @Version: 1.0.0
 * @Autor: lqc
 * @Date: 2020-05-28 15:36:25
 * @LastEditors: lqc
 * @LastEditTime: 2020-06-01 13:58:50
 * @FilePath: \cesiumVueClean\src\components\CesiumViewer\index.vue
-->
<template>
  <div>
    <div id="cesiumContainer"></div>
  </div>
</template>

<script>
import * as Cesium from 'cesium'
import 'cesium/Build/Cesium/Widgets/widgets.css'

export default {
  mounted() {
    this.initViewer()
  },
  methods: {
    initViewer() {
      var token = '85dcab3699b288cd780476d37fa35805'
      // 服务域名
      var tdtUrl = 'https://t{s}.tianditu.gov.cn/'
      // 服务负载子域
      var subdomains = ['0', '1', '2', '3', '4', '5', '6', '7']
      
      var imgMap = new Cesium.UrlTemplateImageryProvider({
        url: tdtUrl + 'DataServer?T=vec_w&x={x}&y={y}&l={z}&tk=' + token,
        subdomains: subdomains,
        tilingScheme: new Cesium.WebMercatorTilingScheme(),
        maximumLevel: 18,
      })
      
      const viewer = new Cesium.Viewer('cesiumContainer', {
        baseLayerPicker: true,
        fullscreenButton: false,
        geocoder: false,
        homeButton: false,
        navigationHelpButton: false,
        sceneModePicker: false,
        timeline: false,
        animation: false,
        imageryProvider: imgMap
      })
      viewer._cesiumWidget._creditContainer.style.display = 'none'
      viewer.scene.globe.showGroundAtmosphere = false
/*
      let googleMapProvider = new UrlTemplateImageryProvider({
        url: 'https://t6.tianditu.gov.cn/DataServer?T=img_w&x={x}&y={y}&l={z}&tk=85dcab3699b288cd780476d37fa35805'
        //url: 'http://mt1.google.cn/vt/lyrs=s&hl=zh-CN&x={x}&y={y}&z={z}&s=Gali'
      })*/
      //https://t6.tianditu.gov.cn/DataServer?T=cva_w&x={x}&y={y}&l={z}&tk=85dcab3699b288cd780476d37fa35805
      var ciaMap = new Cesium.UrlTemplateImageryProvider({
        url: tdtUrl + 'DataServer?T=cva_w&x={x}&y={y}&l={z}&tk=' + token,
        subdomains: subdomains,
        tilingScheme: new Cesium.WebMercatorTilingScheme(),
        maximumLevel: 18,
      })
      var iboMap = new Cesium.UrlTemplateImageryProvider({
        url: tdtUrl + 'DataServer?T=ibo_w&x={x}&y={y}&l={z}&tk=' + token,
        subdomains: subdomains,
        tilingScheme: new Cesium.WebMercatorTilingScheme(),
        maximumLevel: 18,
      })
      viewer.imageryLayers.addImageryProvider(ciaMap)
      viewer.imageryLayers.addImageryProvider(iboMap)
    
    }
  }
}
</script>

<style scoped>
#cesiumContainer {
  position: absolute;
  top: 0;
  left: 0;
  margin: 0;
  width: 100%;
  height: 100%;
}
</style>
