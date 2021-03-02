import master from '@/pages/welcome';
import welcome from '@/pages/welcome/welcome.vue';

export default { 
  path: '/', name: 'Hello', redirect: { name: 'Hello-World' }, component: master,
  children: [
    {
      path: 'hello-world', name: 'Hello-World', component: welcome,
    }
  ]
}
