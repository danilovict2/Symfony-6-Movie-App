import InfiniteScroll from "infinite-scroll";

const actorsGrid = document.querySelector('.popular-actors-grid');
const infScroll = new InfiniteScroll(actorsGrid, {
    path: '/actors/page/{{#}}',
    append: '.actor',
    status: '.page-load-status',
});