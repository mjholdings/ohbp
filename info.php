<?php



function getAllIdsRecursive($data)
{
    $ids = array(); // Mảng để lưu trữ các id

    // Duyệt qua từng phần tử trong mảng dữ liệu
    foreach ($data as $item) {
        // Nếu phần tử có key là "id", thêm giá trị "id" vào mảng ids
        if (isset ($item['id'])) {
            $ids[] = $item['id'];
        }

        // Nếu phần tử có key là "children" và là một mảng không rỗng, gọi đệ quy để lấy thêm các id của các phần tử con
        if (isset ($item['children']) && is_array($item['children']) && !empty ($item['children'])) {
            $ids = array_merge($ids, getAllIdsRecursive($item['children']));
        }
    }

    return $ids;
}

// Chuỗi JSON đầu vào
$jsonString = '[{"id":"62","children":[{"id":"63","children":[{"id":"64","children":[]}]}]},{"id":"65","children":[]}]';

// Giải nén chuỗi JSON thành mảng PHP
$dataArray = json_decode($jsonString, true);

var_dump($dataArray);
echo "<br>";

// Gọi hàm đệ quy để lấy ra mảng chứa toàn bộ giá trị id từ mảng dữ liệu
$resultIds = getAllIdsRecursive($dataArray);

// In ra mảng các id
print_r($resultIds);



?>