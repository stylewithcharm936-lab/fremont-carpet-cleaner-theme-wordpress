/**
 * Style With Charm - Main Theme JavaScript
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // 1. Mobile Menu Toggle
    var menuOpenBtn = document.getElementById('mobile-menu-open');
    var mobileDrawer = document.getElementById('mobile-nav-drawer');

    if (menuOpenBtn && mobileDrawer) {
      menuOpenBtn.addEventListener('click', function (e) {
        e.stopPropagation();
        var isOpen = mobileDrawer.classList.toggle('is-open');
        document.body.style.overflow = isOpen ? 'hidden' : '';
      });
    }

    // 2. Fullscreen Search Modal
    var searchOpenBtn = document.getElementById('search-modal-open');
    var searchCloseBtn = document.getElementById('search-modal-close');
    var searchModal = document.getElementById('search-modal');
    var searchInput = document.getElementById('search-modal-input');

    function openSearch() {
      if (!searchModal) return;
      searchModal.classList.add('is-open');
      searchModal.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      if (searchInput) {
        setTimeout(function () {
          searchInput.focus();
        }, 100);
      }
    }

    function closeSearch() {
      if (!searchModal) return;
      searchModal.classList.remove('is-open');
      searchModal.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
    }

    if (searchOpenBtn) {
      searchOpenBtn.addEventListener('click', function (e) {
        e.preventDefault();
        openSearch();
      });
    }

    if (searchCloseBtn) {
      searchCloseBtn.addEventListener('click', function (e) {
        e.preventDefault();
        closeSearch();
      });
    }

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && searchModal && searchModal.classList.contains('is-open')) {
        closeSearch();
      }
    });

    // 3. AJAX "Load More" Posts
    var loadMoreBtn = document.getElementById('load-more-btn');
    var postGrid = document.getElementById('post-feed-grid');
    var loadMoreStatus = document.getElementById('load-more-status');

    if (loadMoreBtn && postGrid && typeof swc_ajax !== 'undefined') {
      loadMoreBtn.addEventListener('click', function (e) {
        e.preventDefault();

        var currentPage = parseInt(loadMoreBtn.getAttribute('data-page'), 10) || 1;
        var maxPages = parseInt(loadMoreBtn.getAttribute('data-max-pages'), 10) || 1;
        var categoryId = loadMoreBtn.getAttribute('data-category') || 0;
        var searchQuery = loadMoreBtn.getAttribute('data-search') || '';

        if (currentPage >= maxPages) {
          loadMoreBtn.style.display = 'none';
          return;
        }

        var nextPage = currentPage + 1;
        var originalText = loadMoreBtn.innerText;
        loadMoreBtn.innerText = 'Loading…';
        loadMoreBtn.disabled = true;
        if (loadMoreStatus) loadMoreStatus.style.display = 'none';

        var formData = new FormData();
        formData.append('action', 'swc_load_more');
        formData.append('nonce', swc_ajax.nonce);
        formData.append('page', nextPage);
        formData.append('category_id', categoryId);
        formData.append('search', searchQuery);

        fetch(swc_ajax.ajax_url, {
          method: 'POST',
          body: formData,
        })
          .then(function (response) {
            return response.json();
          })
          .then(function (res) {
            if (res.success && res.data && res.data.html) {
              var tempDiv = document.createElement('div');
              tempDiv.innerHTML = res.data.html;

              while (tempDiv.firstChild) {
                postGrid.appendChild(tempDiv.firstChild);
              }

              loadMoreBtn.setAttribute('data-page', nextPage);
              loadMoreBtn.innerText = originalText;
              loadMoreBtn.disabled = false;

              if (nextPage >= res.data.max_pages) {
                loadMoreBtn.style.display = 'none';
              }
            } else {
              loadMoreBtn.innerText = originalText;
              loadMoreBtn.disabled = false;
              if (loadMoreStatus) {
                loadMoreStatus.innerText = 'No more articles to load.';
                loadMoreStatus.style.display = 'block';
              }
            }
          })
          .catch(function (err) {
            console.error('Error loading more posts:', err);
            loadMoreBtn.innerText = originalText;
            loadMoreBtn.disabled = false;
            if (loadMoreStatus) {
              loadMoreStatus.innerText = 'Could not load more posts. Please try again.';
              loadMoreStatus.style.display = 'block';
            }
          });
      });
    }
  });
})();
