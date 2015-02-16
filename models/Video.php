<?php

// http://www.phptherightway.com/#databases_interacting

class Video
{
    protected $db;

    private $table = 'vs_inventory';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllVideos($category_selection)
    {
        $videos = array();

        if ($category_selection == 'all') {
            $videosQuery = $this->db->query("SELECT * FROM {$this->table}");
        } else {
            $stmt = $this->db->prepare("
                SELECT *
                  FROM {$this->table}
                 WHERE category LIKE :category
            ");

            $stmt->bindParam(':category', $category_selection, PDO::PARAM_STR);

            $stmt->execute();

            $videosQuery = $stmt->fetchAll();
        }

        foreach ($videosQuery as $videoRow) {
            $videos[] = $this->generateVideoArray($videoRow);
        }

        return $videos;
    }

    public function getAllCategories()
    {
        $categories = array();

        $categoriesQuery = $this->db->query("
              SELECT category
                FROM vs_inventory
            GROUP BY category;
        ");

        foreach ($categoriesQuery as $categoryRow) {
            $categories[] = $categoryRow['category'];
        }

        return $categories;
    }

    public function getVideo($id)
    {
        $stmt = $this->db->prepare("
            SELECT *
              FROM {$this->table}
             WHERE id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $videoQuery = $stmt->execute();

        if ($videoQuery) {
            $videoRow = $stmt->fetch();

            return $this->generateVideoArray($videoRow);
        }

        return false;
    }

    private function generateVideoArray($rowData)
    {
        $video = array(
            'id'          => $rowData['id'],
            'name'        => $rowData['name'],
            'category'    => $rowData['category'],
            'length'      => $rowData['length'],
            'rented'      => $rowData['rented'],
        );

        if ($video['rented']) {
            $video['rentedLabel'] = 'Checked Out';
        } else {
            $video['rentedLabel'] = 'Available';
        }

        return $video;
    }

    public function addVideo($name, $category, $length)
    {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} (name, category, length)
            VALUES (:name, :category, :length)
        ");

        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':length', $length, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteAllVideos()
    {
        // http://dev.mysql.com/doc/refman/5.0/en/truncate-table.html
        return $this->db->query("TRUNCATE {$this->table}");
    }

    public function deleteVideo($id)
    {
        $stmt = $this->db->prepare("
            DELETE FROM {$this->table}
                  WHERE id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function checkInVideo($id)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
               SET rented=false
             WHERE id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function checkOutVideo($id)
    {
        $stmt = $this->db->prepare("
            UPDATE {$this->table}
               SET rented=true
             WHERE id = :id
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}