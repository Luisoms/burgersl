var scrollValue = 0;

function scrollTox(scrollValue){
  window.scrollTo({
    top: scrollValue,
    behavior: 'smooth'
  });
}