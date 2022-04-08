<?php
class ReviewsController
{
    private $dbcon;

    public function __construct($dbcon) {
        $this->dbcon = $dbcon;
    }

    public function insert($product_id, $review, $rating) {
        $query = "INSERT INTO review (product_id, review, rating) VALUES ('$product_id', '$review', '$rating')";
        mysqli_query($this->dbcon, $query);
    }

    public function getReviews() {
        $reviews_by_product = array();
        for ($i = 1; $i <= 12; $i++) {
            $total_query = "SELECT COUNT(review.product_id) AS TotalReviews, ROUND(AVG(stars), 1) AS AverageRating, product.name, product.image
                FROM review
                JOIN product ON product.product_id = review.product_id
                WHERE review.product_id = $i";                        
            $total = mysqli_query($this->dbcon, $total_query);


            $reviews_query = "SELECT text, stars
                FROM review 
                WHERE review.product_id = $i
                ORDER BY stars DESC";                        
            $reviews = mysqli_query($this->dbcon, $reviews_query);


            $output = mysqli_fetch_assoc($total);

            $reviews_text = array();
            while($row = mysqli_fetch_assoc($reviews)) {
                array_push($reviews_text, $row);
            }

            array_push($reviews_by_product, array($output, $reviews_text));
        }
        $data = mb_convert_encoding($reviews_by_product,'UTF-8', 'UTF-8');
        echo json_encode($data);
    }
}

?>
