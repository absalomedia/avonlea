<?php

namespace Avonlea\Controller;

/**
 * Cart Class.
 *
 * @category    Cart
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class Cart extends Front
{
    public function summary()
    {
        $data['inventoryCheck'] = \AVL::checkInventory();
        $this->partial('cart_summary', $data);
    }

    public function addToCart()
    {
        // Get our inputs
        $productId = intval(\CI::input()->post('id'));
        $quantity = intval(\CI::input()->post('quantity'));
        $options = \CI::input()->post('option');

        $message = \AVL::insertItem(['product' => $productId, 'quantity' => $quantity, 'postedOptions' => $options]);

        //save the cart
        \AVL::saveCart();

        echo $message;
    }

    public function updateCart()
    {
        // see if we have an update for the cart
        $product_id = \CI::input()->post('product_id');
        $quantity = \CI::input()->post('quantity');

        $item = \AVL::getCartItem($product_id);

        if (!$item) {
            return json_encode(['error' => lang('error_product_not_found')]);
        }
        if (intval($quantity) === 0) {
            \AVL::removeItem($product_id);
            echo json_encode(['success' => true]);
        } else {
            //create a new list of relevant items
            $item->quantity = $quantity;
            $insert = \AVL::insertItem(['product' => $item, 'quantity' => $quantity]);
            echo $insert;
        }

        //save the cart updates
        \AVL::saveCart();

        return true;
    }

    public function submitCoupon()
    {
        $coupon = \AVL::setCoupon(\CI::input()->post('coupon'));
        \AVL::saveCart();
        echo $coupon;
    }

    public function submitGiftCard()
    {
        //get the giftcards from the database
        $giftCard = \CI::GiftCards()->getGiftCard(\CI::input()->post('gift_card'));

        if (!$giftCard) {
            echo json_encode(['error' => lang('gift_card_not_exist')]);
        } else {
            //does the giftcard have any value left?
            if (\CI::GiftCards()->isValid($giftCard)) {
                $message = \AVL::setGiftCard($giftCard);
                if ($message['success']) {
                    \AVL::saveCart();
                    echo json_encode(['message' => lang('gift_card_balance_applied')]);
                } else {
                    echo json_encode($message);
                }
            } else {
                echo json_encode(['error' => lang('gift_card_zero_balance')]);
            }
        }
    }
}
