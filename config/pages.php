<?php

/*
|--------------------------------------------------------------------------
| Static Information Pages
|--------------------------------------------------------------------------
|
| Content for the customer-service pages linked from the site footer.
| Each page maps a URL slug to a title, intro and a list of sections.
|
*/

return [

    'shipping' => [
        'eyebrow' => 'Customer Service',
        'title' => 'Shipping & Delivery',
        'intro' => 'Everything you need to know about how Aroma prepares and delivers your fragrance.',
        'sections' => [
            [
                'heading' => 'Processing Time',
                'body' => [
                    'Orders are carefully packed and dispatched within 1–2 business days of confirmation.',
                    'You will receive an order confirmation as soon as your order is placed, and a dispatch update once it leaves our studio.',
                ],
            ],
            [
                'heading' => 'Delivery Time',
                'body' => [
                    'Standard delivery across India usually takes 3–6 business days, depending on your location.',
                    'Remote pin codes may require an additional 1–2 business days.',
                ],
            ],
            [
                'heading' => 'Shipping Charges',
                'body' => [
                    'Shipping is free on all prepaid orders above ₹999.',
                    'A flat shipping fee of ₹79 applies to orders below that value.',
                ],
            ],
            [
                'heading' => 'Order Tracking',
                'body' => [
                    'Once your order is shipped, tracking details are shared on your registered email address.',
                    'You can also review the status of every order from the Orders section of your account.',
                ],
            ],
        ],
    ],

    'returns' => [
        'eyebrow' => 'Customer Service',
        'title' => 'Returns & Refunds',
        'intro' => 'We want you to love your fragrance. If something is not right, here is how we can help.',
        'sections' => [
            [
                'heading' => 'Return Window',
                'body' => [
                    'You may request a return within 7 days of delivery for products that arrive damaged, defective or incorrect.',
                    'For hygiene and safety reasons, opened or used fragrances cannot be returned unless the item is faulty.',
                ],
            ],
            [
                'heading' => 'How to Request a Return',
                'body' => [
                    'Contact our support team with your order number and a short description of the issue, along with photographs of the product and packaging where possible.',
                ],
            ],
            [
                'heading' => 'Refund Timeline',
                'body' => [
                    'Once your return is received and inspected, refunds are processed within 5–7 business days.',
                    'Refunds are issued to the original payment method used at checkout.',
                ],
            ],
        ],
    ],

    'privacy' => [
        'eyebrow' => 'Legal',
        'title' => 'Privacy Policy',
        'intro' => 'Your privacy matters to us. This policy explains what information Aroma collects and how it is used.',
        'sections' => [
            [
                'heading' => 'Information We Collect',
                'body' => [
                    'We collect the details you provide when you create an account, place an order or contact us — such as your name, email address, phone number and delivery address.',
                ],
            ],
            [
                'heading' => 'How We Use Your Information',
                'body' => [
                    'Your information is used to process orders, deliver your fragrance, respond to enquiries and keep you updated about your purchases.',
                    'We never sell or rent your personal information to third parties.',
                ],
            ],
            [
                'heading' => 'Data Security',
                'body' => [
                    'We take reasonable technical and organisational measures to protect the information you share with us.',
                ],
            ],
            [
                'heading' => 'Your Choices',
                'body' => [
                    'You may update your profile details at any time, and you can ask us to delete your account by contacting support.',
                ],
            ],
        ],
    ],

    'terms' => [
        'eyebrow' => 'Legal',
        'title' => 'Terms & Conditions',
        'intro' => 'By using the Aroma website and placing an order, you agree to the following terms.',
        'sections' => [
            [
                'heading' => 'Orders & Pricing',
                'body' => [
                    'All prices are listed in Indian Rupees and are inclusive of applicable taxes.',
                    'We reserve the right to cancel an order if a product is unavailable or if pricing has been listed incorrectly.',
                ],
            ],
            [
                'heading' => 'Accounts',
                'body' => [
                    'You are responsible for keeping your account credentials secure and for all activity that takes place under your account.',
                ],
            ],
            [
                'heading' => 'Intellectual Property',
                'body' => [
                    'All content on this website, including text, images and branding, belongs to Aroma and may not be reproduced without permission.',
                ],
            ],
            [
                'heading' => 'Changes to These Terms',
                'body' => [
                    'We may update these terms from time to time. Continued use of the website means you accept the latest version.',
                ],
            ],
        ],
    ],

    'faqs' => [
        'eyebrow' => 'Customer Service',
        'title' => 'Frequently Asked Questions',
        'intro' => 'Quick answers to the questions our customers ask most often.',
        'sections' => [
            [
                'heading' => 'Are Aroma fragrances long lasting?',
                'body' => [
                    'Yes. Our fragrances are formulated with a high concentration of fragrance oils, so a single application typically lasts 6–8 hours on skin.',
                ],
            ],
            [
                'heading' => 'How should I store my perfume?',
                'body' => [
                    'Keep your bottle away from direct sunlight and heat, ideally in a cool, dry place, to preserve the scent for longer.',
                ],
            ],
            [
                'heading' => 'Do you offer samples?',
                'body' => [
                    'We periodically include complimentary samples with orders. Keep an eye on our collections page for discovery sets.',
                ],
            ],
            [
                'heading' => 'How can I track my order?',
                'body' => [
                    'Visit the Orders section of your account to view the status of any order, or use the tracking link shared by email.',
                ],
            ],
        ],
    ],

];
