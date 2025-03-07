<?php
/**
 * 快速排序
 *
 * @author   ShaoWei Pu <pushaowei0727@gmail.com>
 * @date     2017/6/17
 * @license  MIT
 * -------------------------------------------------------------
 * 思路分析：从数列中挑出一个元素，称为 “基准”（pivot) 
 * 大O表示： O(n log n) 最糟 O(n 2)
 * -------------------------------------------------------------
 * 重新排序数列，所有元素比基准值小的摆放在基准前面，C 语言中的 qsort就是快速排序
 * 所有元素比基准值大的摆在基准的后面（相同的数可以到任一边）。
 * 递归地（recursive）把小于基准值元素的子数列和大于基准值元素的子数列排序
 */

// +--------------------------------------------------------------------------
// | 解题方式
// +--------------------------------------------------------------------------

/**
 * QuickSort
 *
 * @param array $container
 * @return array
 */
function QuickSort(array $container)
{
    $count = count($container);
    if ($count <= 1) { // 基线条件为空或者只包含一个元素，只需要原样返回数组
        return $container;
    }
    $pivot = $container[0]; // 基准值 pivot
    $left  = $right = [];

    for ($i = 1; $i < $count; $i++) {
        if ($container[$i] < $pivot) {
            $left[] = $container[$i];
        } else {
            $right[] = $container[$i];
        }
    }
    $left  = QuickSort($left);
    $right = QuickSort($right);
    return array_merge($left, [$container[0]], $right);
}

/**
 * 找到中间点
 *
 * @param $r
 * @param $low
 * @param $high
 *
 * @return mixed
 */
function findMidpoint(&$r, $low, $high)
{
    $x = $r[$low];

    while ($low < $high) {
        while (($low < $high) && $r[$high] >= $x) {
            $high--;
        }
        $r[$low] = $r[$high];

        while ($low < $high && $r[$low] <= $x) {
            $low++;
        }
        $r[$high] = $r[$low];
    }

    $r[$low] = $x;
    return $low;
}

/**
 * 快速排序，第二种实现
 *
 * @param      $r
 * @param int  $low
 * @param null $high
 */
function QuickSort2(&$r, $low = 0, $high = null)
{
    $high === null && $high = count($r) - 1;

    if ($low < $high) {
        $temp = findMidpoint($r, $low, $high);
        QuickSort2($r, $low, $temp - 1);
        QuickSort2($r, $temp + 1, $high);
    }
}


// +--------------------------------------------------------------------------
// | 方案测试
// +--------------------------------------------------------------------------


var_dump(QuickSort([4, 21, 41, 2, 53, 1, 213, 31, 21, 423]));
/**
 * array(10) {
 * [0] =>
 * int(1)
 * [1] =>
 * int(2)
 * [2] =>
 * int(4)
 * [3] =>
 * int(21)
 * [4] =>
 * int(21)
 * [5] =>
 * int(31)
 * [6] =>
 * int(41)
 * [7] =>
 * int(53)
 * [8] =>
 * int(213)
 * [9] =>
 * int(423)
 * }
 */
/**
 * PS & EX:
 *  快速排序使用分而治之【 divide and conquer,D&C 】的策略，D&C 解决问题的过程包括两个步骤
 *  1. 找出基线条件，这种条件必须尽可能简单
 *  2. 不断将问题分解（或者说缩小规模），直到符合基线条件
 * （D&C 并非解决问题的算法，而是一种解决问题的思路）
 */

// 当数据量大时，比如100万时，比第一种快速排序快大概0.4s
$a = [];
for ($i = 0; $i<100;$i++) {
    $a[] = random_int(0,99999);
}
echo microtime(true) . PHP_EOL;
QuickSort2($a);
var_dump($a);
echo microtime(true) . PHP_EOL;