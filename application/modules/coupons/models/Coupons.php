<?php
/**
 * Coupons Class.
 *
 * @category    Coupons
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class Coupons extends CI_Model
{
    public function save($coupon)
    {
        if (!$coupon['id']) {
            return $this->addCoupon($coupon);
        } else {
            $this->updateCoupon($coupon['id'], $coupon);

            return $coupon['id'];
        }
    }

    // add coupon, returns id
    public function addCoupon($data)
    {
        CI::db()->insert('coupons', $data);

        return CI::db()->insert_id();
    }

    // update coupon
    public function updateCoupon($optn, $data)
    {
        CI::db()->where('id', $optn)->update('coupons', $data);
    }

    // delete coupon
    public function deleteCoupon($optn)
    {
        CI::db()->where('id', $optn);
        CI::db()->delete('coupons');

        // delete children
        $this->removeProduct($optn);
    }

    // checks coupon dates and usage numbers
    public function isValid($coupon)
    {
        if ($coupon->max_uses != 0 && $coupon->num_uses >= $coupon->max_uses) {
            return false;
        }
        if ($coupon->start_date != '0000-00-00') {
            $start = strtotime($coupon->start_date);

            $current = time();

            if ($current < $start) {
                return false;
            }
        }

        if ($coupon->end_date != '0000-00-00' && !empty($coupon->end_date)) {
            $end = strtotime($coupon->end_date) + 86400; // add a day for the availability to be inclusive

            $current = time();

            if ($current > $end) {
                return false;
            }
        }

        return true;
    }

    // increment coupon uses
    public function touchCoupon($code)
    {
        CI::db()->where('code', $code)->set('num_uses', 'num_uses+1', false)->update('coupons');
    }

    // get coupons list, sorted by start_date (default), end_date
    public function getCoupons($sort = null)
    {
        if ($sort == 'end_date') {
            CI::db()->order_by('end_date');
        } else {
            CI::db()->order_by('start_date');
        }

        return CI::db()->get('coupons')->result();
    }

    // get coupon details, by id
    public function getCoupon($optn)
    {
        return CI::db()->where('id', $optn)->get('coupons')->row();
    }

    // get coupon details, by code
    public function getCouponByCode($code)
    {
        CI::db()->where('code', $code);
        $return = CI::db()->get('coupons')->row();

        if (!$return) {
            return false;
        }
        $return->product_list = $this->getProductIds($return->id);

        return $return;
    }

    public function checkCode($str, $optn = false)
    {
        CI::db()->select('code');
        CI::db()->where('code', $str);
        if ($optn) {
            CI::db()->where('id !=', $optn);
        }
        $count = CI::db()->count_all_results('coupons');

        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addProducts($coupon_id, $products)
    {
        if (!empty($products)) {
            $save = [];

            foreach ($products as $p) {
                $save[] = [
                    'coupon_id'  => $coupon_id,
                    'product_id' => $p['id'],
                ];
            }

            if (!empty($save)) {
                CI::db()->insert_batch('coupons_products', $save);
            }
        }
    }

    // add product to coupon
    public function addProduct($coupon_id, $prod_id)
    {
        CI::db()->insert('coupons_products', ['coupon_id' => $coupon_id, 'product_id' => $prod_id]);
    }

    // remove product from coupon. Product id as null for removing all products
    public function removeProduct($coupon_id, $prod_id = null)
    {
        $where = ['coupon_id' => $coupon_id];

        if (!is_null($prod_id)) {
            $where['product_id'] = $prod_id;
        }

        CI::db()->where($where);
        CI::db()->delete('coupons_products');
    }

    // get list of products in coupon with full info
    public function getProducts($coupon_id)
    {
        CI::db()->join('products', 'product_id=products.id');
        CI::db()->where('coupon_id', $coupon_id);

        return CI::db()->get('coupons_products')->result();
    }

    // Get list of product id's only - utility function
    public function getProductIds($coupon_id)
    {
        CI::db()->select('product_id');
        CI::db()->where('coupon_id', $coupon_id);
        $res = CI::db()->where('coupon_id', $coupon_id)->get('coupons_products')->result();

        $list = [];
        foreach ($res as $item) {
            $list[] = $item->product_id;
        }

        return $list;
    }
}
