// Variables
/* global VERTICAL_SLIDER */
const siteURL = VERTICAL_SLIDER.rest_url;

const sliderContext = document.querySelector('#slider-context');
const sliderPagination = document.querySelector('#slider-pagination');
const shortCodeId = sliderContext.getAttribute('data-shortcode-id');
const shortCodeSlug = sliderContext.getAttribute('data-shortcode-slug');
const slides = [];
const counterObj = {
  value: 0
};
let touchStart = 0;
let touchEnd = 0;

let pagination = '';
let circleBehavior = '';
let scrolling = false;


// Async function of fetching data with id or slug.
const fetchSliderData = async (id, slug) => {
  try {
    if (id) {
      const response = await fetch(`${siteURL}wp/v2/vertical_slider/${id}?_fields=custom_rest_api`);
      if (!response.ok) {
        throw new Error(`Error fetching data. HTTP status ${response.status}`);
      }
      const data = await response.json();
      return data;
    } else if (!id && slug) {
      const response = await fetch(`${siteURL}wp/v2/vertical_slider?slug=${slug}&_fields=custom_rest_api`);
      if (!response.ok) {
        throw new Error(`Error fetching data. HTTP status ${response.status}`);
      }
      const data = await response.json();
      if (data && data.length > 0) {
        return data[0];
      }
      throw new Error(`No data found for slug ${slug}`);
    }
    return null;
  } catch (error) {
    console.error('Fetch error:', error.message);
    throw error;
  }
};

// Fetching initiation
fetchSliderData(shortCodeId, shortCodeSlug).then((slider) => {
  // Check if the response is any false value.
  if (!slider) {
    console.error('[ucf_vertical_slide] Please provide either the correct Shortcode ID or Shortcode Slug.');
    return;
  }

  const slidesArray = slider.custom_rest_api;

  // Controllers
  slidesArray.forEach((element) => {
    const slide = `
      <div class="col-xs-12 col-lg-6 text-center text-light h-100">
          <img class="slider-image" src="${element.img_url}" alt="${element.title}"   />
      </div>
      <div  class="col-xs-0 col-lg-6 text-light slider-text-box">
          <p class="employee-name display-4 font-weight-bold text-primary">${element.title}</p>
          <p class="employee-title h3" >${element.sub_title}</p>
          <br>
          <p class="employee-desc h5">${element.description}</p>
      </div>`;

    slides.push(slide);
  });
  sliderContext.innerHTML = slides[counterObj.value];

  // Events /////////////////////
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
  paginationFunc(counterObj.value);

  // scrolling Function
  const scrollFunc = (event) => {
    // Check if scrolling action is in progress
    if (scrolling) {
      return;
    }

    // Set the scrolling flag to true
    scrolling = true;
    let newCounter;

    if (event.deltaY > 0 && counterObj.value < slides.length - 1) {
      newCounter = counterObj.value + 1;
    } else if (event.deltaY < 0 && counterObj.value > 0) {
      newCounter = counterObj.value - 1;
    }

    // Update the content only if the counter has changed
    if (newCounter !== undefined) {
      counterObj.value = newCounter;
      sliderContext.innerHTML = slides[counterObj.value];
      paginationFunc(counterObj.value);
    }

    // Reset the scrolling flag after the delay
    setTimeout(() => {
      scrolling = false;
    }, 1500); // 1000 milliseconds (1 second) delay
  };

  sliderContext.addEventListener('wheel', scrollFunc);

  // Disable scrolling behavior when the mouse enters the sliderContext area, and enable it when the mouse leaves.
  const terminateScroll = (counterObj, slides, activateScroll) => {
    if (counterObj.value > 0 && counterObj.value < slides.length - 1) {
      document.body.style.overflow = 'hidden';
      return;
    }
    activateScroll();
  };

  const activateScroll = () => {
    document.body.style.overflow = 'visible';
  };


  // Key Up Down Functions
  const keyPress = (event) => {
    let flag = true;

    if (event.key === 'ArrowUp' && counterObj.value > 0) {
      counterObj.value--;
    } else if (event.key === 'ArrowDown' && counterObj.value < slides.length - 1) {
      counterObj.value++;
    } else {
      flag = false;
    }

    if (flag) {
      sliderContext.innerHTML = slides[counterObj.value];
      paginationFunc(counterObj.value);
    }
  };


  let isFirstTouch = true; // Flag to track the first touch

  // touch start Func
  const touchStartFunc = (e) => {
    touchStart = e.changedTouches[0].clientY;
    // Prevent default touch behavior (scrolling)
    if (isFirstTouch || counterObj.value < slides.length - 1 && counterObj.value > 0) {
      e.preventDefault();
      isFirstTouch = false; // Set flag to false after the first touch
    }


  };

  // Touch end Func
  const touchEndFunc = (e) => {
    touchEnd = e.changedTouches[0].clientY;

    if (touchEnd < touchStart) {
      if (counterObj.value < slides.length - 1) {
        counterObj.value++;
        sliderContext.innerHTML = slides[counterObj.value]; // Update slide content
        paginationFunc(counterObj.value); // Update pagination
      } else {
        isFirstTouch = true;
      }
    } else if (touchEnd > touchStart) {
      if (counterObj.value > 0) {
        counterObj.value--;
        sliderContext.innerHTML = slides[counterObj.value]; // Update slide content
        paginationFunc(counterObj.value); // Update pagination
      } else {
        isFirstTouch = true;
      }
    }
  };

  // Add the event listener after the function declaration
  document.addEventListener('keydown', keyPress);

  sliderContext.addEventListener('mouseleave', activateScroll);
  sliderContext.addEventListener('mouseenter', () => terminateScroll(counterObj, slides, activateScroll));

  sliderContext.addEventListener('touchstart', touchStartFunc);
  sliderContext.addEventListener('touchend', touchEndFunc);
});

