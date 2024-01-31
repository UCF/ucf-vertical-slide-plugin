// Variables
const sliderContext = document.querySelector('#slider-context');
const sliderPagination = document.querySelector('#slider-pagination');
const shortCodeId = sliderContext.getAttribute('data-shortcode-id');
const shortCodeSlug = sliderContext.getAttribute('data-shortcode-slug');
const slides = [];

let counter = 0;
let pagination = '';
let circleBehavior = '';
let scrolling = false;

// Async function of fetching data with id or slug.
const fetchSliderData = async (id, slug) => {

  try {
    if (id) {
      const response = await fetch(`http://localhost/wp-local/wp-json/wp/v2/vertical_slider/${id}?_fields=custom_rest_api`);
      if (!response.ok) {
        throw new Error(`Error fetching data. HTTP status ${response.status}`);
      }
      const data = await response.json();
      return data;

    } else if (!id && slug) {
      const response = await fetch(`http://localhost/wp-local/wp-json/wp/v2/vertical_slider?slug=${slug}&_fields=custom_rest_api`);
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

  sliderContext.addEventListener('wheel', scrollFunc);

});

