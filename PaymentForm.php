<?php

namespace uzdevid\FreeKassa;

class PaymentForm extends \yii\base\Component {
    public $merchantId;
    public $secretWord;
    public $amount;
    public $paymentId;
    public $currency;

    public $phone;
    public $email;
    public $lang;
    public $us;

    public function sendInvoiceByGet() {
        $url = 'https://pay.freekassa.ru/';
        $signature = [
            $this->merchantId,
            $this->amount,
            $this->secretWord,
            $this->currency,
            $this->paymentId
        ];

        $signature = md5(implode(':', $signature));
        $params = [
            'm' => $this->merchantId,
            'oa' => $this->amount,
            'currency' => $this->currency,
            'o' => $this->paymentId,
            's' => $signature
        ];

        if ($this->phone)
            $params['phone'] = $this->phone;

        if ($this->email)
            $params['em'] = $this->email;

        if ($this->lang)
            $params['lang'] = $this->lang;

        if ($this->us)
            $params = array_merge($params, $this->us);

        return $url . '?' . htmlspecialchars(http_build_query($params));
    }
}
