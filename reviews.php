<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>review</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styles/reviews.css">
<?php include 'navigation.php' ?>
</head>
<body>

    <section class="reviews" id="reviews">
        <h1 class="heading">
            <span>R</span>
            <span>E</span>
            <span>V</span>
            <span>I</span>
            <span>E</span>
            <span>W</span>
            <span>S</span>
        </h1>
        <br><br>
        <div class="container">
            <h1>Review Your Experience</h1>
            <form id="review-form">
                <label for="name">Name:</label>
                <input type="text" id="name" required><br>
                <label for="rating">Rating:</label>
                <select id="rating" required>
                    <option value="1">★</option>
                    <option value="2">★★</option>
                    <option value="3">★★★</option>
                    <option value="4">★★★★</option>
                    <option value="5">★★★★★</option>
                </select><br>
                <label for="review">Review:</label>
                <textarea id="review" required></textarea><br>
                <button type="submit" id="submit-btn">Submit</button>
            </form>
        </div>
        
        <div class="customer-reviews">
            <h2 class="customer-reviews-heading">Customer Reviews</h2>
            <div id="customer-reviews-container"></div> <!-- Changed id to customer-reviews-container -->
        </div>
        
    </section>

    <script src="js/script1.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reviewForm = document.getElementById('review-form');
            const customerReviewsContainer = document.getElementById('customer-reviews-container');
            let reviews = JSON.parse(localStorage.getItem('reviews')) || [];

            // Load saved reviews on page load
            if (reviews.length > 0) {
                reviews.forEach(function(review) {
                    renderReview(review);
                });
            }

            reviewForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const name = document.getElementById('name').value;
                const rating = document.getElementById('rating').value;
                const reviewText = document.getElementById('review').value;

                // Create review object
                const newReview = {
                    name: name,
                    rating: rating,
                    reviewText: reviewText
                };

                // Save review to localStorage
                reviews.push(newReview);
                localStorage.setItem('reviews', JSON.stringify(reviews));

                // Render review
                renderReview(newReview);

                // Clear form fields
                document.getElementById('name').value = '';
                document.getElementById('rating').value = '1';
                document.getElementById('review').value = '';
            });

            // Function to render a review
            function renderReview(review) {
                const reviewElement = document.createElement('div');
                reviewElement.classList.add('review');
                reviewElement.innerHTML = `
                    <p><strong>Name:</strong> ${review.name}</p>
                    <p><strong>Rating:</strong> ${review.rating}</p>
                    <p><strong>Review:</strong> ${review.reviewText}</p>
                    <button class="delete-btn">Delete</button>
                `;

                customerReviewsContainer.appendChild(reviewElement);

                // Attach delete functionality to delete button
                const deleteBtn = reviewElement.querySelector('.delete-btn');
                deleteBtn.addEventListener('click', function() {
                    reviewElement.remove();

                    // Remove review from reviews array
                    reviews = reviews.filter(function(item) {
                        return item !== review;
                    });

                    // Update localStorage
                    localStorage.setItem('reviews', JSON.stringify(reviews));
                });
            }
        });
    </script>
    <?php include 'footer.php' ?>
</body>
</html>
