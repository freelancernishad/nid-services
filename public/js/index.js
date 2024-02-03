<script>
googletag.cmd.push(function () {
    googletag.display('div-gpt-ad-1624958658889-0');
});
</script>

<script>
                  googletag.cmd.push(function () {
                      googletag.display('div-gpt-ad-1627731590993-0');
                  });
               </script>

<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script async src="https://cdn.dhakapost.com/assets/common/js/loader.js"></script>
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
      <script>
         let economyItems = document.querySelectorAll('.economy-item');
         let ectItems = document.querySelectorAll('.ect-items');
         ectItems.forEach(item => {
             item.addEventListener('click', () => {
                 ectItems.forEach(item => {
                     item.classList.remove('active');
                 });
                 item.classList.add('active');
                 let data = item.getAttribute('data-href');
         
                 document.querySelectorAll('.economy-item').forEach(item => {
                     item.style.display = "none";
                 });
         
                 let economy = document.querySelector('.' + data);
                 economy.style.display = 'flex';
         
                 if (economy.children.length === 0) {
                     requestEconomyContent(data);
                 }
         
             });
         });
         
         let sportsItems = document.querySelectorAll('.sports-item');
         let sctItems = document.querySelectorAll('.sct-items');
         sctItems.forEach(item => {
             item.addEventListener('click', () => {
                 sctItems.forEach(item => {
                     item.classList.remove('active');
                 });
                 item.classList.add('active');
                 let data = item.getAttribute('data-href');
         
                 document.querySelectorAll('.sports-item').forEach(item => {
                     item.style.display = "none";
                 });
         
                 let sports = document.querySelector('.' + data);
                 sports.style.display = 'flex';
         
                 if (sports.children.length === 0) {
                     requestSportsContent(data);
                 }
         
             });
         });
         
         const probashButtonRight = document.querySelector('.probash-menu-scroll.menu-scroll-right');
         const probashButtonLeft = document.querySelector('.probash-menu-scroll.menu-scroll-left');
         const probashItems = document.querySelector('.probash-country-items');
         const scrollWidth = probashItems.scrollWidth - probashItems.clientWidth;
         let countryItems = document.querySelectorAll('.country-item');
         let ctItems = document.querySelectorAll('.ct-items');
         
         probashButtonRight.onclick = function () {
             probashItems.scrollLeft += 100;
         
             if (probashItems.scrollLeft == scrollWidth) {
                 probashButtonRight.classList.remove('active');
                 probashButtonRight.classList.add('inactive');
             }
         
             if (probashItems.scrollLeft == 100) {
                 probashButtonLeft.classList.remove('inactive');
                 probashButtonLeft.classList.add('active');
             }
         };
         probashButtonLeft.onclick = function () {
             probashItems.scrollLeft -= 100;
         
             if (probashItems.scrollLeft == 0) {
                 probashButtonLeft.classList.remove('active');
                 probashButtonLeft.classList.add('inactive');
             }
         
             if (probashItems.scrollLeft == scrollWidth - 100) {
                 probashButtonRight.classList.remove('inactive');
                 probashButtonRight.classList.add('active');
             }
         };
         ctItems.forEach(item => {
             item.addEventListener('click', () => {
                 ctItems.forEach(item => {
                     item.classList.remove('active');
                 });
                 item.classList.add('active');
                 let data = item.getAttribute('data-href');
         
                 document.querySelectorAll('.country-item').forEach(item => {
                     item.style.display = "none";
                 });
         
                 let country = document.querySelector('.' + data);
                 country.style.display = 'flex';
         
                 if (country.children.length === 0) {
                     requestCountryContent(data);
                 }
         
             });
         });
         
         let entertainmentItems = document.querySelectorAll('.entertainment-item');
         let etItems = document.querySelectorAll('.et-items');
         etItems.forEach(item => {
             item.addEventListener('click', () => {
                 etItems.forEach(item => {
                     item.classList.remove('active');
                 });
                 item.classList.add('active');
                 let data = item.getAttribute('data-href');
         
                 document.querySelectorAll('.entertainment-item').forEach(item => {
                     item.style.display = "none";
                 });
         
                 let entertainment = document.querySelector('.' + data);
                 entertainment.style.display = 'flex';
         
                 if (entertainment.children.length === 0) {
                     requestEntertainmentContent(data);
                 }
         
             });
         });
         
         async function requestEconomyContent(value) {
             let url = '/more/home/economy';
             let request = await fetch(url + '?slug=' + value);
             document.querySelector('.' + value).innerHTML = await request.text();
         
             let images = document.querySelectorAll('.economy-item.' + value + ' .img-loader');
             intersect(images);
         }
         
         async function requestSportsContent(value) {
             let url = '/more/home/sports';
             let request = await fetch(url + '?slug=' + value);
             document.querySelector('.' + value).innerHTML = await request.text();
         
             let images = document.querySelectorAll('.sports-item.' + value + ' .img-loader');
             intersect(images);
         }
         
         async function requestEntertainmentContent(value) {
             let url = '/more/home/entertainment';
             let request = await fetch(url + '?slug=' + value);
             document.querySelector('.' + value).innerHTML = await request.text();
         
             let images = document.querySelectorAll('.entertainment-item.' + value + ' .img-loader');
             intersect(images);
         }
         
         async function requestCountryContent(value) {
             let url = '/more/home/countries';
             let request = await fetch(url + '?slug=' + value);
             document.querySelector('.' + value).innerHTML = await request.text();
         
             let images = document.querySelectorAll('.country-item.' + value + ' .img-loader');
             intersect(images);
         }
      </script>
      <div id='div-gpt-ad-1624691711930-0'>
         <script>
            googletag.cmd.push(function () {
                googletag.display('div-gpt-ad-1624691711930-0');
            });
         </script>

         <script>
         function hideFooterAd() {
             document.querySelector('.footer-ad').style.display = "none";
             document.querySelector('footer').style.paddingBottom = "10px";
         }
      </script>
   </div>
   <script>
      const navigatorExtra = document.querySelector('.navigator-extra');
      const slideUpBtn = document.querySelector('[data-target="slide-up"]');
      const slideContent = document.querySelector('[data-target="slide-content"]');
      slideUpBtn.addEventListener("click", slideUp);
      
      function slideDown(e) {
          e.preventDefault();
          slideContent.classList.add("d-flex");
          slideContent.classList.remove("d-none");
          slideContent.style.position = 'sticky';
          navigatorExtra.children[0].style.display = "none";
      }
      
      function slideUp(e) {
          e.preventDefault();
          slideContent.classList.add("d-none");
          slideContent.classList.remove("d-flex");
          slideContent.style.position = 'unset';
          navigatorExtra.children[0].style.display = "flex";
      }
   </script>
   <script>
      (function () {
          "use strict";
          window.addEventListener(
              "load",
              function () {
                  // Fetch all the forms we want to apply custom Bootstrap validation styles to
                  let forms = document.getElementsByClassName("needs-validation");
                  // Loop over them and prevent submission
                  let validation = Array.prototype.filter.call(forms, function (form) {
                      form.addEventListener(
                          "submit",
                          function (event) {
                              if (form.checkValidity() === false) {
                                  event.preventDefault();
                                  event.stopPropagation();
                              }
                              form.classList.add("was-validated");
                          },
                          false
                      );
                  });
              },
              false
          );
      })();
   </script>
   <script>
      const slideDownBtn = document.querySelector('[data-target="slide-down"]');
      slideDownBtn.addEventListener("click", slideDown);
   </script>
   <script>
      let selector = document.querySelector('.dis-sea');
      let division = document.getElementById("division");
      let district = document.getElementById("district");
      
      selector.setAttribute('disabled', '');
      let upazila = document.getElementById("upazila");
      
      division.addEventListener('change', (event) => {
          if (event.target.value !== "" && event.target.value !== null) {
              districtCall(event.target.value);
              upazila.innerHTML = "";
              firstChildUpazila();
          } else {
              selector.setAttribute('disabled', '');
              district.innerHTML = "";
              firstChildDistrict();
              upazila.innerHTML = "";
              firstChildUpazila();
          }
      });
      
      district.addEventListener('change', (event) => {
          if (event.target.value !== "" && event.target.value !== null) {
              selector.removeAttribute('disabled');
              upazilaCall(event.target.value);
              upazila.innerHTML = "";
              firstChildUpazila();
          } else {
              selector.setAttribute('disabled', '');
              upazila.innerHTML = "";
              firstChildUpazila();
          }
      });
      
      async function districtCall(value) {
          let url = 'https://www.dhakapost.com/districts';
          let request = await fetch(url + '/' + value);
          district.innerHTML = await request.text();
          firstChildDistrict();
      }
      
      async function upazilaCall(value) {
          let url = 'https://www.dhakapost.com/upazilas';
          let request = await fetch(url + '/' + value);
          upazila.innerHTML = await request.text();
          firstChildUpazila();
      }
      
      function firstChildUpazila() {
          let option = document.createElement('option');
          option.value = "";
          option.selected = true;
          option.textContent = "উপজেলা";
          upazila.insertBefore(option, upazila.firstChild);
      }
      
      function firstChildDistrict() {
          let option = document.createElement('option');
          option.value = "";
          option.selected = true;
          option.textContent = "জেলা";
          district.insertBefore(option, district.firstChild);
      }
      
      selector.addEventListener(
          "click",
          function (event) {
              let url = window.location.origin;
              if (division.selectedOptions[0].getAttribute("data-value") !== null && district.selectedOptions[0].getAttribute("data-value") !== null) {
                  url = "/country/" + district.selectedOptions[0].getAttribute("data-value");
      
                  if (upazila.selectedOptions[0].getAttribute("data-value") !== null) {
                      url += "/" + upazila.selectedOptions[0].getAttribute("data-value");
                  }
                  window.location.href = url + '-news';
              }
          },
          false
      );
   </script>
   <script>(function(){var js = "window['__CF$cv$params']={r:'7831215ae8f2bc2b',m:'uhazp5DmXPsbbz1IsqUq1CIa_yFvdk.bvevbsfhcuuk-1672637716-0-AW3lhCC2DFUPq5e2cpiWDmSltaF77H9Sz+4qCfX+Hb9qle95kfsPxO+8F0KiNasFXaTDsznt9Fj8VD+9nJHluARWoYH8hzCyFYytxZqRSrHooEFGJy0FPyFaZXFtvVKs4w==',s:[0xe2113daadd,0x1b208440ba],u:'/cdn-cgi/challenge-platform/h/g'};var now=Date.now()/1000,offset=14400,ts=''+(Math.floor(now)-Math.floor(now%offset)),_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='/cdn-cgi/challenge-platform/h/g/scripts/alpha/invisible.js?ts='+ts,document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.position = 'absolute';_0xh.style.top = 0;_0xh.style.left = 0;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.nonce = '';_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script><script defer src="https://static.cloudflareinsights.com/beacon.min.js/vaafb692b2aea4879b33c060e79fe94621666317369993" integrity="sha512-0ahDYl866UMhKuYcW078ScMalXqtFJggm7TmlUtp0UlD4eQk0Ixfnm5ykXKvGJNFjLMoortdseTfsRT8oCfgGA==" data-cf-beacon='{"rayId":"7831215ae8f2bc2b","token":"f1eeba4b80594b39ae5e5e624e12d357","version":"2022.11.3","si":100}' crossorigin="anonymous"></script>