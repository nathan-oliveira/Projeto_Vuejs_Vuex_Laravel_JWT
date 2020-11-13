<template>
  <div class="col-md-4 col-sm-6">
    <ul class="timeline">
      <li>
        <div class="timeline-item">
          <span class="time"><i class="fa fa-clock-o"></i> {{ datetime }}</span>
          <h3 class="timeline-header">
            <img
              class="img-circle"
              :src="imagem"
            />
            <a href="#">{{ author.split(' ')[0] }} {{  author.split(' ')[1] }}</a>
          </h3>
          <slot></slot>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: ['author', 'datetime', 'imagem'],
};
</script>

<style scoped>
.timeline:before {
  display: none;
}

.timeline > li > .timeline-item {
  margin-left: 0px;
  margin-right: 0px;
}

.timeline > li > .timeline-item > .time {
  padding: 16px;
}

.timeline > li {
  position: relative;
  margin-right: 0px;
  margin-bottom: 0px;
}

.timeline-header img {
  width: 30px;
  margin-right: 10px;
}
</style>
