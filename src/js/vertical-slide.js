// Object of faculties description
const faculties = [
  {
    id: 1,
    title: 'Charles brown',
    imageAddress: 'https://wwwtest.ucf.edu/wp-content/blogs.dir/16/files/2024/01/personPic.png',
    subtitle: 'Web developer',
    des: 'At Humane, I can feel the love, care, and respect everyone has for one another.'
  },
  {
    id: 2,
    title: 'Nick green',
    imageAddress: 'https://wwwtest.ucf.edu/wp-content/blogs.dir/16/files/2024/01/personPic1.png',
    subtitle: 'Graphic designer',
    des: 'At Humane, I can feel the love, care, and respect everyone has for one another.'
  },
  {
    id: 3,
    title: 'Sophia pink',
    imageAddress: 'https://wwwtest.ucf.edu/wp-content/blogs.dir/16/files/2024/01/personPic5.png',
    subtitle: 'Content creator',
    des: 'At Humane, I can feel the love, care, and respect everyone has for one another.'
  }
];

// Preload images
const preloadImages = (images) => {
  const imageObjects = [];

  for (const image of images) {
    const img = new Image();
    img.src = image;
    imageObjects.push(img);
  }

  return imageObjects;
};

const imageAddresses = faculties.map((faculty) => faculty.imageAddress);
preloadImages(imageAddresses);

// Variables
const slides = [];
let counter = 0;
let pagination = '';
let circleBehavior = '';

// Controllers
const sliderContext = document.querySelector('#slider-context');
const sliderPagination = document.querySelector('#slider-pagination');

faculties.forEach((element) => {
  const slide = `
      <div class="col-xs-12 col-lg-6 text-center text-light h-100">
          <img class="" src="${element.imageAddress}" alt="${element.title}"  />
      </div>
      <div  class="col-xs-0 col-lg-6 text-light slider-text-box">
          <p class="employee-name display-4 font-weight-bold text-primary">${element.title}</p>
          <p class="employee-title h3" >${element.subtitle}</p>
          <br>
          <p class="employee-desc h5">${element.des}</p>
      </div>`;

  slides.push(slide);
});
sliderContext.innerHTML = slides[counter];

// Events
// Pagination Function
const paginationFunc = (counter) => {
  pagination = '';
  slides.forEach((element, index) => {
    circleBehavior = index === counter ? 'yellow' : 'white';
    pagination += `<svg style="display:block" height="50" width="50">
          <circle cx="25" cy="25" r="5" stroke="black" stroke-width="1" fill="${circleBehavior}" />
      </svg>`;
  });
  sliderPagination.innerHTML = pagination;
};
paginationFunc(counter);

// scrolling Function
let scrolling = false;

const scrollFunc = (event) => {
  // Check if scrolling action is in progress
  if (scrolling) {
    return;
  }
  // Set the scrolling flag to true
  scrolling = true;

  let newCounter;

  if (event.deltaY > 0 && counter < slides.length - 1) {
    newCounter = counter + 1;
  } else if (event.deltaY < 0 && counter > 0) {
    newCounter = counter - 1;
  }

  // Update the content only if the counter has changed
  if (newCounter !== undefined) {
    counter = newCounter;
    sliderContext.innerHTML = slides[counter];
    paginationFunc(counter);
  }

  // Reset the scrolling flag after the delay
  setTimeout(() => {
    scrolling = false;
  }, 1500); // 1000 milliseconds (1 second) delay
};

document.addEventListener('wheel', scrollFunc);