<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">

    <title>-</title>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4264401469889345"
     crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/site_logo/favourite_icon_2.svg') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
       <style>
        /* Simple styling for the Table of Contents */
        .toc {
            margin: 20px 0;
            padding: 10px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .toc h2 {
            margin-top: 0;
        }
        .toc ul {
            list-style-type: none;
            padding-left: 0;
        }
        .toc ul li {
            margin: 5px 0;
        }
        .toc ul li a {
            text-decoration: none;
            color: #007bff;
        }
        .toc ul li a:hover {
            text-decoration: underline;
        }
        .toc ul li .toc-number {
            font-weight: bold;
            margin-right: 5px;
            color: #333;
        }
    </style>
  </head>


  <body>
    <div class="page_wrapper">
      <div id="preloader" class="preloader">
        <div class="loader-circle">
          <div class="loader-line-mask">
            <div class="loader-line"></div>
          </div>
          <div class="loader-logo">
            <img src="{{ asset('assets/images/site_logo/site_logo_2.svg') }}" alt="Site Logo – Techco – IT Solutions &amp; Technology Site Template">
          </div>
        </div>
      </div>
      <div class="backtotop">
        <a href="#" class="scroll">
          <i class="fa-solid fa-arrow-up"></i>
        </a>
      </div>

      <main class="page_content">
        <section class="page_banner_section text-center" style="background-image: url('{{ asset('assets/images/shapes/bg_pattern_4.svg') }}');">
          <div class="container">
            <h1 class="page_title mb-0 text-white">Blog Details</h1>
          </div>
        </section>
        <section class="blog_details_section section_space bg-light">

            <div class="container">
              <div class="details_item_image">
                <img id="generativeImage" src="">
              </div>
              <div class="section_space pb-0">
                <div class="row">
                    <div class="col-lg-8">
                        {!! $data !!}
                    </div>
                    <div class="col-lg-4">
                        <ins class="adsbygoogle"
                            style="display:block"
                            data-ad-client="ca-pub-4264401469889345"
                            data-ad-slot="8491042847"
                            data-ad-format="auto"
                            data-full-width-responsive="true"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>

              </div>

          </div>
        </section>
      </main>
      <footer class="site_footer footer_layout_1">

        <div class="footer_bottom">
          <div class="container d-md-flex align-items-md-center justify-content-md-between">
            <p class="copyright_text m-0">
              Copyright © 2024 Techco, All rights reserved.
            </p>

          </div>
        </div>
      </footer>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find the <h1> element without a class
            var h1WithoutClass = document.querySelector('h1:not([class])');

            // Find the <h1> element with the specific class
            var h1WithClass = document.querySelector('h1.page_title.mb-0.text-white');

            if (h1WithoutClass && h1WithClass) {
                // Apply the text from <h1> without class to <h1> with class
                h1WithClass.textContent = h1WithoutClass.textContent;
            }

            var firstParagraph = document.querySelector('p');
            var descriptionContent = '';

            if (firstParagraph) {
                // Get the text content of the first <p> tag
                var textContent = firstParagraph.textContent.trim();
                    console.log(textContent);
                // Limit to 130 characters and add ellipsis if necessary
                if (textContent.length > 130) {
                    descriptionContent = textContent.substring(0, 130) + '...';
                } else {
                    descriptionContent = textContent;
                }
            }

            // Set the content attribute of the meta description tag
            var metaDescription = document.querySelector('meta[name="description"]');
            if (metaDescription) {
                metaDescription.setAttribute('content', descriptionContent);
            }
            // Create Table of Contents container
            var tocContainer = document.createElement('div');
            tocContainer.className = 'toc';
            var tocTitle = document.createElement('h2');
            tocTitle.textContent = 'Table of Contents';
            tocContainer.appendChild(tocTitle);

            var tocList = document.createElement('ul');
            tocContainer.appendChild(tocList);

            // Find all headings from h1 to h6
            var headings = Array.from(document.querySelectorAll('h1, h2, h3, h4, h5, h6'));

            // Track numbering for headings
            var numbering = { 'h1': 1, 'h2': 1, 'h3': 1, 'h4': 1, 'h5': 1, 'h6': 1 };
            var prevLevel = '';

            // Helper function to generate heading IDs if not present
            function generateId(text) {
                return text.toLowerCase().replace(/\s+/g, '-');
            }

            // Add each heading to the Table of Contents
            headings.forEach(function(heading, index) {
                var level = heading.tagName.toLowerCase();
                var listItem = document.createElement('li');
                var numberSpan = document.createElement('span');
                numberSpan.className = 'toc-number';

                // Number the headings
                var number = numbering[level];
                numberSpan.textContent = number + '.';
                numbering[level]++;

                var link = document.createElement('a');
                link.href = '#' + (heading.id || generateId(heading.textContent));
                link.textContent = heading.textContent;

                // Add an id to the heading if it doesn't already have one
                if (!heading.id) {
                    heading.id = generateId(heading.textContent);
                }

                listItem.appendChild(numberSpan);
                listItem.appendChild(link);
                tocList.appendChild(listItem);

                // Handle child headings
                var nextLevel = 'h' + (parseInt(level.charAt(1)) + 1);
                if (headings[index + 1] && headings[index + 1].tagName.toLowerCase() === nextLevel) {
                    numbering[nextLevel] = 1;
                }

                // Add subheadings to the current heading
                var subHeadings = headings.slice(index + 1).filter(function(h) {
                    return h.tagName.toLowerCase().startsWith(level);
                });

                if (subHeadings.length > 0) {
                    var subList = document.createElement('ul');
                    listItem.appendChild(subList);

                    subHeadings.forEach(function(subHeading) {
                        var subItem = document.createElement('li');
                        var subNumberSpan = document.createElement('span');
                        subNumberSpan.className = 'toc-number';

                        // Number the subheadings
                        var subNumber = (number + '.' + numbering[nextLevel]++);
                        subNumberSpan.textContent = subNumber + '.';

                        var subLink = document.createElement('a');
                        subLink.href = '#' + (subHeading.id || generateId(subHeading.textContent));
                        subLink.textContent = subHeading.textContent;

                        if (!subHeading.id) {
                            subHeading.id = generateId(subHeading.textContent);
                        }

                        subItem.appendChild(subNumberSpan);
                        subItem.appendChild(subLink);
                        subList.appendChild(subItem);
                    });
                }
            });

            // Insert the Table of Contents right after the <h1> without class
            if (h1WithoutClass) {
                h1WithoutClass.parentNode.insertBefore(tocContainer, h1WithoutClass.nextSibling);
            }

            // Set the <title> element's content to the <h1> text
            if (h1WithClass) {
                document.title = h1WithClass.textContent;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Find the <h1> element without a class
            var h1Element = document.querySelector('h1:not([class])');

            if (h1Element) {
                // Get the text content of the <h1> element
                var h1Text = h1Element.textContent.trim();

                // Form the new image URL using the <h1> text
                var newImageUrl = `https://picsum.photos/seed/${encodeURIComponent(h1Text)}/1200/760`;

                // Find the image element and update its src attribute
                var imageElement = document.getElementById('generativeImage');
                if (imageElement) {
                    imageElement.src = newImageUrl;
                }
            }
        });
    </script>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create the AdSense ad HTML
            var adHTML = `
                <ins class="adsbygoogle"
                     style="display:inline-block;width:650px;height:350px"
                     data-ad-client="ca-pub-4264401469889345"
                     data-ad-slot="9229409447"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                <\/script>
            `;

            // Select the first three <p> elements
            var paragraphs = document.querySelectorAll('p');
            for (var i = 0; i < 3 && i < paragraphs.length; i++) {
                // Insert the AdSense HTML into each of the first three <p> elements
                paragraphs[i].innerHTML += adHTML;
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the content of the first <p> tag
            var firstParagraph = document.querySelector('p');
            var descriptionContent = '';

            if (firstParagraph) {
                // Get the text content of the first <p> tag
                descriptionContent = firstParagraph.textContent.trim();
            }

            // Set the content attribute of the meta description tag
            var metaDescription = document.querySelector('meta[name="description"]');
            if (metaDescription) {
                metaDescription.setAttribute('content', descriptionContent);
            }
        });
    </script>
  </body>
</html>
