PGDMP                      |           matsuri_shop    16.2    16.2 Q    A           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            B           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            C           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            D           1262    17412    matsuri_shop    DATABASE     �   CREATE DATABASE matsuri_shop WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Slovak_Slovakia.1250';
    DROP DATABASE matsuri_shop;
                postgres    false            �            1259    19766    cache    TABLE     �   CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache;
       public         heap    postgres    false            �            1259    19773    cache_locks    TABLE     �   CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);
    DROP TABLE public.cache_locks;
       public         heap    postgres    false            �            1259    19874 
   cart_items    TABLE     �   CREATE TABLE public.cart_items (
    id uuid NOT NULL,
    cart_id uuid NOT NULL,
    product_id uuid NOT NULL,
    quantity integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.cart_items;
       public         heap    postgres    false            �            1259    19837    carts    TABLE     �   CREATE TABLE public.carts (
    id uuid NOT NULL,
    user_id uuid,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.carts;
       public         heap    postgres    false            �            1259    19847 
   categories    TABLE     �   CREATE TABLE public.categories (
    id uuid NOT NULL,
    name character varying(16) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.categories;
       public         heap    postgres    false            �            1259    19793    failed_jobs    TABLE       CREATE TABLE public.failed_jobs (
    uuid uuid NOT NULL,
    id uuid NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);
    DROP TABLE public.failed_jobs;
       public         heap    postgres    false            �            1259    19786    job_batches    TABLE     R  CREATE TABLE public.job_batches (
    id uuid NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);
    DROP TABLE public.job_batches;
       public         heap    postgres    false            �            1259    19780    jobs    TABLE     �   CREATE TABLE public.jobs (
    uuid uuid NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);
    DROP TABLE public.jobs;
       public         heap    postgres    false            �            1259    19719 
   migrations    TABLE     �   CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);
    DROP TABLE public.migrations;
       public         heap    postgres    false            �            1259    19718    migrations_id_seq    SEQUENCE     �   CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.migrations_id_seq;
       public          postgres    false    216            E           0    0    migrations_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;
          public          postgres    false    215            �            1259    19889    order_items    TABLE     �   CREATE TABLE public.order_items (
    id uuid NOT NULL,
    order_id uuid NOT NULL,
    product_id uuid NOT NULL,
    quantity integer NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.order_items;
       public         heap    postgres    false            �            1259    19811    orders    TABLE     �  CREATE TABLE public.orders (
    id uuid NOT NULL,
    user_id uuid,
    address_id uuid NOT NULL,
    payment_method_id uuid NOT NULL,
    shipping_method_id uuid NOT NULL,
    total numeric(8,2) NOT NULL,
    order_status character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT orders_order_status_check CHECK (((order_status)::text = ANY ((ARRAY['PENDING'::character varying, 'FINISHED'::character varying])::text[])))
);
    DROP TABLE public.orders;
       public         heap    postgres    false            �            1259    19745    password_reset_tokens    TABLE     �   CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);
 )   DROP TABLE public.password_reset_tokens;
       public         heap    postgres    false            �            1259    19725    payment_methods    TABLE     �   CREATE TABLE public.payment_methods (
    id uuid NOT NULL,
    name character varying(15) NOT NULL,
    price numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 #   DROP TABLE public.payment_methods;
       public         heap    postgres    false            �            1259    19857    products    TABLE     �  CREATE TABLE public.products (
    id uuid NOT NULL,
    name character varying(130) NOT NULL,
    description character varying(1500) NOT NULL,
    category_id uuid NOT NULL,
    series_id uuid NOT NULL,
    price numeric(8,2) NOT NULL,
    discount numeric(8,2) NOT NULL,
    stock integer NOT NULL,
    main_img character varying(100) NOT NULL,
    side_img_1 character varying(100) NOT NULL,
    side_img_2 character varying(100) NOT NULL,
    publisher character varying(50) NOT NULL,
    author character varying(100),
    pages integer NOT NULL,
    dimensions character varying(21),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.products;
       public         heap    postgres    false            �            1259    19852    series    TABLE     �   CREATE TABLE public.series (
    id uuid NOT NULL,
    name character varying(100) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
    DROP TABLE public.series;
       public         heap    postgres    false            �            1259    19752    sessions    TABLE     �   CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id uuid,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);
    DROP TABLE public.sessions;
       public         heap    postgres    false            �            1259    19801    shipping_addresses    TABLE     �  CREATE TABLE public.shipping_addresses (
    id uuid NOT NULL,
    first_name character varying(50) NOT NULL,
    last_name character varying(50) NOT NULL,
    country character varying(10) NOT NULL,
    city character varying(26) NOT NULL,
    zip character varying(6) NOT NULL,
    phone character varying(15) NOT NULL,
    address character varying(35) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 &   DROP TABLE public.shipping_addresses;
       public         heap    postgres    false            �            1259    19806    shipping_methods    TABLE     �   CREATE TABLE public.shipping_methods (
    id uuid NOT NULL,
    name character varying(15) NOT NULL,
    price numeric(8,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);
 $   DROP TABLE public.shipping_methods;
       public         heap    postgres    false            �            1259    19730    users    TABLE     D  CREATE TABLE public.users (
    id uuid NOT NULL,
    email character varying(320) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(60) NOT NULL,
    matsuri_points integer NOT NULL,
    role character varying(255) NOT NULL,
    preferred_payment_id uuid,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT users_role_check CHECK (((role)::text = ANY ((ARRAY['ADMIN'::character varying, 'CUSTOMER'::character varying])::text[])))
);
    DROP TABLE public.users;
       public         heap    postgres    false            b           2604    19722    migrations id    DEFAULT     n   ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);
 <   ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
       public          postgres    false    216    215    216            1          0    19766    cache 
   TABLE DATA           7   COPY public.cache (key, value, expiration) FROM stdin;
    public          postgres    false    221   ^k       2          0    19773    cache_locks 
   TABLE DATA           =   COPY public.cache_locks (key, owner, expiration) FROM stdin;
    public          postgres    false    222   �k       =          0    19874 
   cart_items 
   TABLE DATA           _   COPY public.cart_items (id, cart_id, product_id, quantity, created_at, updated_at) FROM stdin;
    public          postgres    false    233   �k       9          0    19837    carts 
   TABLE DATA           D   COPY public.carts (id, user_id, created_at, updated_at) FROM stdin;
    public          postgres    false    229   �l       :          0    19847 
   categories 
   TABLE DATA           F   COPY public.categories (id, name, created_at, updated_at) FROM stdin;
    public          postgres    false    230   am       5          0    19793    failed_jobs 
   TABLE DATA           a   COPY public.failed_jobs (uuid, id, connection, queue, payload, exception, failed_at) FROM stdin;
    public          postgres    false    225   Nn       4          0    19786    job_batches 
   TABLE DATA           �   COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
    public          postgres    false    224   kn       3          0    19780    jobs 
   TABLE DATA           e   COPY public.jobs (uuid, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
    public          postgres    false    223   �n       ,          0    19719 
   migrations 
   TABLE DATA           :   COPY public.migrations (id, migration, batch) FROM stdin;
    public          postgres    false    216   �n       >          0    19889    order_items 
   TABLE DATA           a   COPY public.order_items (id, order_id, product_id, quantity, created_at, updated_at) FROM stdin;
    public          postgres    false    234   xo       8          0    19811    orders 
   TABLE DATA           �   COPY public.orders (id, user_id, address_id, payment_method_id, shipping_method_id, total, order_status, created_at, updated_at) FROM stdin;
    public          postgres    false    228   |p       /          0    19745    password_reset_tokens 
   TABLE DATA           I   COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
    public          postgres    false    219   �q       -          0    19725    payment_methods 
   TABLE DATA           R   COPY public.payment_methods (id, name, price, created_at, updated_at) FROM stdin;
    public          postgres    false    217   �q       <          0    19857    products 
   TABLE DATA           �   COPY public.products (id, name, description, category_id, series_id, price, discount, stock, main_img, side_img_1, side_img_2, publisher, author, pages, dimensions, created_at, updated_at) FROM stdin;
    public          postgres    false    232   5r       ;          0    19852    series 
   TABLE DATA           B   COPY public.series (id, name, created_at, updated_at) FROM stdin;
    public          postgres    false    231   ǌ       0          0    19752    sessions 
   TABLE DATA           _   COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
    public          postgres    false    220   �       6          0    19801    shipping_addresses 
   TABLE DATA           �   COPY public.shipping_addresses (id, first_name, last_name, country, city, zip, phone, address, created_at, updated_at) FROM stdin;
    public          postgres    false    226   Đ       7          0    19806    shipping_methods 
   TABLE DATA           S   COPY public.shipping_methods (id, name, price, created_at, updated_at) FROM stdin;
    public          postgres    false    227   �       .          0    19730    users 
   TABLE DATA           �   COPY public.users (id, email, email_verified_at, password, matsuri_points, role, preferred_payment_id, remember_token, created_at, updated_at) FROM stdin;
    public          postgres    false    218   ��       F           0    0    migrations_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.migrations_id_seq', 13, true);
          public          postgres    false    215            w           2606    19779    cache_locks cache_locks_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);
 F   ALTER TABLE ONLY public.cache_locks DROP CONSTRAINT cache_locks_pkey;
       public            postgres    false    222            u           2606    19772    cache cache_pkey 
   CONSTRAINT     O   ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);
 :   ALTER TABLE ONLY public.cache DROP CONSTRAINT cache_pkey;
       public            postgres    false    221            �           2606    19888    cart_items cart_items_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.cart_items
    ADD CONSTRAINT cart_items_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.cart_items DROP CONSTRAINT cart_items_pkey;
       public            postgres    false    233            �           2606    19846    carts carts_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.carts DROP CONSTRAINT carts_pkey;
       public            postgres    false    229            �           2606    19851    categories categories_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.categories DROP CONSTRAINT categories_pkey;
       public            postgres    false    230            |           2606    19800 !   failed_jobs failed_jobs_id_unique 
   CONSTRAINT     Z   ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_id_unique UNIQUE (id);
 K   ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_id_unique;
       public            postgres    false    225            z           2606    19792    job_batches job_batches_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.job_batches DROP CONSTRAINT job_batches_pkey;
       public            postgres    false    224            g           2606    19724    migrations migrations_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
       public            postgres    false    216            �           2606    19903    order_items order_items_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_pkey PRIMARY KEY (id);
 F   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_pkey;
       public            postgres    false    234            �           2606    19836    orders orders_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_pkey;
       public            postgres    false    228            o           2606    19751 0   password_reset_tokens password_reset_tokens_pkey 
   CONSTRAINT     q   ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);
 Z   ALTER TABLE ONLY public.password_reset_tokens DROP CONSTRAINT password_reset_tokens_pkey;
       public            postgres    false    219            i           2606    19729 $   payment_methods payment_methods_pkey 
   CONSTRAINT     b   ALTER TABLE ONLY public.payment_methods
    ADD CONSTRAINT payment_methods_pkey PRIMARY KEY (id);
 N   ALTER TABLE ONLY public.payment_methods DROP CONSTRAINT payment_methods_pkey;
       public            postgres    false    217            �           2606    19873    products products_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.products DROP CONSTRAINT products_pkey;
       public            postgres    false    232            �           2606    19856    series series_pkey 
   CONSTRAINT     P   ALTER TABLE ONLY public.series
    ADD CONSTRAINT series_pkey PRIMARY KEY (id);
 <   ALTER TABLE ONLY public.series DROP CONSTRAINT series_pkey;
       public            postgres    false    231            r           2606    19763    sessions sessions_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);
 @   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
       public            postgres    false    220            ~           2606    19805 *   shipping_addresses shipping_addresses_pkey 
   CONSTRAINT     h   ALTER TABLE ONLY public.shipping_addresses
    ADD CONSTRAINT shipping_addresses_pkey PRIMARY KEY (id);
 T   ALTER TABLE ONLY public.shipping_addresses DROP CONSTRAINT shipping_addresses_pkey;
       public            postgres    false    226            �           2606    19810 &   shipping_methods shipping_methods_pkey 
   CONSTRAINT     d   ALTER TABLE ONLY public.shipping_methods
    ADD CONSTRAINT shipping_methods_pkey PRIMARY KEY (id);
 P   ALTER TABLE ONLY public.shipping_methods DROP CONSTRAINT shipping_methods_pkey;
       public            postgres    false    227            k           2606    19744    users users_email_unique 
   CONSTRAINT     T   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);
 B   ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
       public            postgres    false    218            m           2606    19742    users users_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    218            x           1259    19785    jobs_queue_index    INDEX     B   CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);
 $   DROP INDEX public.jobs_queue_index;
       public            postgres    false    223            p           1259    19765    sessions_last_activity_index    INDEX     Z   CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);
 0   DROP INDEX public.sessions_last_activity_index;
       public            postgres    false    220            s           1259    19764    sessions_user_id_index    INDEX     N   CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);
 *   DROP INDEX public.sessions_user_id_index;
       public            postgres    false    220            �           2606    19877 %   cart_items cart_items_cart_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.cart_items
    ADD CONSTRAINT cart_items_cart_id_foreign FOREIGN KEY (cart_id) REFERENCES public.carts(id) ON DELETE CASCADE;
 O   ALTER TABLE ONLY public.cart_items DROP CONSTRAINT cart_items_cart_id_foreign;
       public          postgres    false    229    4740    233            �           2606    19882 (   cart_items cart_items_product_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.cart_items
    ADD CONSTRAINT cart_items_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.cart_items DROP CONSTRAINT cart_items_product_id_foreign;
       public          postgres    false    233    4746    232            �           2606    19840    carts carts_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.carts
    ADD CONSTRAINT carts_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.carts DROP CONSTRAINT carts_user_id_foreign;
       public          postgres    false    218    4717    229            �           2606    19892 (   order_items order_items_order_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_order_id_foreign FOREIGN KEY (order_id) REFERENCES public.orders(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_order_id_foreign;
       public          postgres    false    4738    228    234            �           2606    19897 *   order_items order_items_product_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.order_items
    ADD CONSTRAINT order_items_product_id_foreign FOREIGN KEY (product_id) REFERENCES public.products(id) ON DELETE CASCADE;
 T   ALTER TABLE ONLY public.order_items DROP CONSTRAINT order_items_product_id_foreign;
       public          postgres    false    234    4746    232            �           2606    19820     orders orders_address_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_address_id_foreign FOREIGN KEY (address_id) REFERENCES public.shipping_addresses(id) ON DELETE CASCADE;
 J   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_address_id_foreign;
       public          postgres    false    226    4734    228            �           2606    19825 '   orders orders_payment_method_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_payment_method_id_foreign FOREIGN KEY (payment_method_id) REFERENCES public.payment_methods(id) ON DELETE CASCADE;
 Q   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_payment_method_id_foreign;
       public          postgres    false    4713    228    217            �           2606    19830 (   orders orders_shipping_method_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_shipping_method_id_foreign FOREIGN KEY (shipping_method_id) REFERENCES public.shipping_methods(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_shipping_method_id_foreign;
       public          postgres    false    4736    228    227            �           2606    19815    orders orders_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.orders
    ADD CONSTRAINT orders_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;
 G   ALTER TABLE ONLY public.orders DROP CONSTRAINT orders_user_id_foreign;
       public          postgres    false    218    228    4717            �           2606    19862 %   products products_category_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_foreign FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;
 O   ALTER TABLE ONLY public.products DROP CONSTRAINT products_category_id_foreign;
       public          postgres    false    4742    232    230            �           2606    19867 #   products products_series_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_series_id_foreign FOREIGN KEY (series_id) REFERENCES public.series(id) ON DELETE CASCADE;
 M   ALTER TABLE ONLY public.products DROP CONSTRAINT products_series_id_foreign;
       public          postgres    false    231    232    4744            �           2606    19757 !   sessions sessions_user_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);
 K   ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_user_id_foreign;
       public          postgres    false    4717    218    220            �           2606    19736 (   users users_preferred_payment_id_foreign    FK CONSTRAINT     �   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_preferred_payment_id_foreign FOREIGN KEY (preferred_payment_id) REFERENCES public.payment_methods(id) ON DELETE CASCADE;
 R   ALTER TABLE ONLY public.users DROP CONSTRAINT users_preferred_payment_id_foreign;
       public          postgres    false    217    218    4713            1   @   x�K)NLqH,N�K�ϭ142�3 BC�����"�L+CsCScscC#kN�+�.�ze1z\\\ ?��      2      x������ � �      =   �   x��лqAP{7
%����p����?��[�ܮ���bv"�ᠨ
����[�ŵx��6A�1h9A�'�5��q�Q��Bp�SsBz��¹�)��/FV��?�/����.��� �gέC��p����2�;���*���S�0[�˥7�K?�%��2Ex�@�`�n��.��N8ۗ���,�~��D88��t�6d��>� S�߿�}�MlX      9   �   x�mα�0��ښ"�Bh�L�	y��*E��w��{n��	;b�� ��h���˖W�9��DA.s��	5��[�[?*VT���6�ᓕ��M��*v��t�,!�X���u��%|���de״D�ϭVA����h*�n��z�@}�r�K)_n�=�      :   �   x�uλJE1��z�)���L2�LJ;+[�\�(�9��Jb���X-RR;L��l���OE���T�/�`� (�zR�lyלP�k7 )�E@���$U��x��>��� <�g�,�k��C�< ��P�"h�&�9����r�����a}� �/�D�Qa�M�2'.�������_6dČ�k�'V�J��q]�^Z���;�nQy��?�Ү��;���a\      5      x������ � �      4      x������ � �      3      x������ � �      ,   �   x�e�M� ��a�wi2A��M���[�*�,�G� d�P�
܎2�Α��~O4�(�x�}QBm����=�zr��;�t��A�çm�e��V3�=.�ø,�ܣ6Ƒ�SK)���X�L�g�3��U҅����� o��t�����Cg��%-@]1ȴ/�������!.�qB| �.�-      >   �   x�����1���*^�̯��r������%/���h�4��>p� �0'l�m��eе�M�]a��1%���@�L�toyU�p�AY �F��1#ݖ�����FM������~�n�Ū�P�d:OvHW3�"E|f}VQ8��I�9!P����iSϋ^����un��ĪA�&�泦IV\�m�!�iDz��N��}��o��Qz���V�M ��a�;�I��m�M��^��^������('�p      8   �   x���1nD1Dk�S�X6l�(J������q�-� 4=���c,�	̉`�;�<S)Uk�u� �,�{�ӄFU��-��h�BL=$[u�vց#�B�,u������DXaN�u���vA�N*�yHtJ��duKo��>��|>?��_���P��p<�=���.�nD�� y�s�h@S���Fy=������|�8��BS�)���iaZ�ں�S�-8M�i)p����"��'��Cڃ�;�zݯ���=m>      /      x������ � �      -   }   x�m̻1 �:��p���ia����GB�B4l����W<�R��
2���)���m�R%�+����8�B�x��1�Bg�K]�Ʊ����U(���W�p���l7{��	�?�F�)����+-      <      x��\�r�F�>7�����D\���5���%jEڎ�p�� �a��^���9��0���u"�-�M�$�eV�&���j;�["�B!++��/3�3�A*����O�ܒ��Xa�WE^��좕��O�7Mu��΋^�bQvb��������B�m9����{�my++!Ӳ*�����}��(�F,;U�ZI<R�s����c�����X(�ܪ�T�*}#:�6^+d��M���-�+粬O�r�h���ǵV���,A4�(�~���2��jU�s�h9�9�-��\�We-�<ܔ�\7�����4��]U�fa�-�ؒ��l�Jt�l�"k�[�B�qWB=|*^5wXN�c�U!{<U5]a[q״�w�P5� dw�C1�[4�����h���S���f��̀�UϱTϟͲ��U�m-�4��"s��Nl+���y���؞�<��"ʬ�v
�B+�=�r2������f�}D3�Եg�,mn��sy�����������M�}����|����C��oU���\�W�ﾸ�9!Dp#�p�����̵]߲˱��9љ�n^s�3�ݣ0��[^�:��Hi��Z2(�<��܍��]٩���6�ξj�۰oY�+u,^4K��,�/���X|��N�����w�w5��˞���5��?�W��uOf�,a�Г�^-���ð\�3*	�p˪��Te͛��Ya%
.�M�����B���(ۮ]	��&�A��54�Ccn.���X�}3W�Mٖ��)O�e9d�^X�"[�yKNG���5����V�&E!�N����3�D�(W4ǍR+��JfJ���S�6Sj����XQG�S�%�Du��Xp�_#)��2��,C�Yk�<)V�W��#�\C����T~,�*Y���f0)�N� ̰�� (���|A*� 4���,�C�Ě��Q��`��V��7�j���H �r.Vm�Vj��q���m�d� ����e[a�p����e�ar)�v��O��Lֿ�s�+%����\*ѐ*3��5�{hN�f��ʌLd){h�;�uT����m!��ڡ[����@�m�`ŝ�Zճ)BJd��D�,+s<(�j-�3�5�p����@�!��vn���a���K5������$��X�S�q��,9M@�m��Y�]���5�u�}|IC�7��$ȳ�����ի������3'qG����'<����.���ϼ�He�An������ZIK+����,Lü�)�W��������R�qS��h��2����8_�X\?�xi����6��om[\Q�����P޸��K�z[�u4�� �jy�6�'#T�a �	V���V��Q��{q:� ��4T<���}=D�\Q��5�[������0�ޣ��,�L~�I��6��y8�c�q���Wo3%;>�#Wz�m���vl�
�(	s���Ʊ
��/���D�_<@�?F������?p?5@<�w];�]G)�,�D�+m,6�|+�v!s'��Xn��3��������E�j���~9�P��R�,*B!D7&k-���B���e��5�%�P�9\e���' n�q�,j\��˔�)$����F�;�0��m����L��nhI,����Y�d�y�Fɷ�SKꦆXKl����)KN��)[!V��j.!9��aq��	�	�n[��f�G�HC�AFo�h~ 5V{S7w ���L���c;�(���ɳQjZ�� EaRMa���=����L�|M�ť�Z��{�%55�_wY��/�r��t�݌���Ʋh�nIxef��UW%B�Uu����o�hs�E�A�����{��/�$�9���Ԭ�6ڄ�S"���C[��EG�BәDC��V�U���M�r{ƛT"����(m�T����I����'�R�i���j9g�v�l�+���dUCABJ��  WB�y�����9���9z_���? �����|*zg����(��$E�����,߇F[b��ґ�T��M�g��J���}ENN��T�a ���aO������>Ƞ�<�e��$q|
!O�0�܉UӴ $��0Ӳ:���̙B��3z�r�y
�=S �©���D��j5z�&ix��dc{URB=�2�a7�hL7O��O�	�М>c�$U@��Эʌ�;'�#��"+*J0	�:l�	��V��cf��7V����^��]׎?H� ɬ0��"xKKzN��y�E��vJ����������zX1|Xx{�L��Ղ6Q� �p^v� #+#^�p�ph��"�G�J����|�Wȳ�;/��jo�L�);]'�$����]E�"�R�j{9?�����g��* N��c�Vr"c
��k1�	�fB:ϧ��w4w�L��`��%i� �o$���4��������sμ�4ݡ�@��\;���(,ۍ#����I!�Y��女��Ù�a�(Q	�������=���c͆~z'�	q��br���6mK����a;�l���6i��(�[-�y	�9��.ЀR�����!�9������u���	(��L�eJ�z+[��}��J<�Z6�
9��l��!��S���Y2���{%0	�J�#�6ܚ��k���g��������'�e6�]׎r_fv��,"Xd`�V��Բm���|�"�{��(I����!���O-��JG�qC�$l��Z�P��2��9���Q9���T���3J�vxM�B���ѵ�r�����?�6�۠h�6G��9��mv�|{׵#��0�ۊ��B�%V��J
�s�0̕�.�����΂�mP������6�g�Ì��EY�`s]+�N��J���I�"p��s��%�+gL9^P�P��CU��7֙������%�1ꥮ�^�ϥa#�������`'OZ�Q��Y��n�̢Z���u]��W�BB�g�kaATP�N03����=`�������+*��*:�9QpR�3��X�Vɪ��i�4h?�ؔy���xu*^��ZF�
����)$��ֺ+�:��*f'��C�*ݨv0��5��5U�*�u�A��q~* Q?���܎��Z&����@pV�;��Lo��
�c��N޶�h�&)u�&��tY|l\s)�����9�ɍ�dP�����`�S{����ˮȮ2z�����?ȕ�l�$Q� a"U&=+��<v�8�&虡~	�aC߬�l^q]�^y�է+�/���{���^�x���Kq}�����̋�����;��|�����摕�1P	�k%�� ��a�uE�^Gug�W�i*�
95m�ڌ2C�P�F*I�֌���|f���';���6���\�7Ɨ0�E��2�7��9e~TC٤f��f�y�q�L���b6���T^�&f$e��A����<��/�(�j�B
r�N�5!n`R2K�Y#���7�ݐ���qzPw�� ,K0���A2�'���|(�7� �����TMw�~*�w.��ˏ/���N-j��t}X��w����ѩ�X��B�ގzD-"�7]ƾ����SI͂	��Y�>�p�=�v���"�d"u�t�#�t9��pL�\��G;=�B��Q�q
!4E��	��$-2����˼_�T�`�qY쿣�#����x&�0��>��ܥ���D�h��(|r�8�~���Oas�|Pq�-!+��k,TmrtО~�I~����EN#�Wy��!>�������o붜��U�L�N����o������ò|@W��' ��0!�'�
"eËI������<�i�ƒģ�P;��<� �+���lY�Y�א��5$�kHvr$����Q��Y��pk��<�d$3+��$rcϳ���3n���R��"7�1�G|��.TR�F8˃Yr���(�q=�i��J�ER`w;U�(�!�rK�������
��%���JW1�է=j
w&	W�B�`ͩJn/�%���9q᫤P<&� ��K��~�B�G�W�3�`|j�&ުP��eGvl���K��U9���>��GE�yJbz�I�8��/��c?��y�.��k��Ϟ'�'��@ʊb�~ab%aXq�<�Qj��a�1�?v7%ui�c��m� }
  h��;��"�8�!��;�=��A
�I<2Dh�2e�v���y��h�}�����T��wC*��	���]�k��7@��	��Bq�M���;6�,�Y�[5>�q5�ӧ:煉e��#k�p�^=�T�5����b����J�@�c�
����j�yBs�P��c�y#�ϑ��n��	xbVS3�C��M��
;�ˡ�.�Xɖ?����9�@H�t�~��1)�UG#��L9���� G6��0�G��J��΃���`V8"�L��	���B+/
�t�g�$��7���wi�=�CF���&�%q�+>�Dp-���w3{� �-7{TNr�s�y!�ő�$Eg�U$98GFVbCKE�R�K�4��_j�/eU����d�ѶM�6�g{����ϳ�(������sC���� ��6-�2GO�,_Ut��I�E!sB��W�I^Z� 痦����Ƿ�<�́Z|��jl���&��Rw��<a�dd��ܚt�jJ�( �.���� 9Q�Ċ�
[B�i�Eо�-�h8���xa��F�����V�RaЀ�C|��VŲn(N���g��� �H--{R3�����c'��2�sޒ]iS�'�F}I�^�[ϔq�T[դy&�4c]�x��G'E�X1����8MRK�I�;2O��=
�d�]�,|�]�7zv����j@x�6M�4x�Vad� 0�,MlO��ؾ�|Du+u��(;9NB���:��B�qE�2r���phI��� �6-����R���K�^\�Jp��;w����b��	��+f�����e9,���+}��O�s:�#�byd��N����R;\�)y��-��D��v���]�p2�<{q��E$�)੝ڡ�pY8`	� iŞo�a(�}Dĝd�:3�=�cO�w��74�����?r�����D��y�-e����^F�b�
e�y�mR�pv	EQ����z%�K���������=���� � 6�Bz�4�F�o�y� ?q%��v�hk�i_�[!����F$c����p]���K����Z��z��"�ۈ�xF�~�^|�^�?�p��}��((�7I	�ɺ`݌�, ��&m�)�`Et:�URݱ�@F9	�^��7��>��D�gK�|}~TN4
��㷒J�j�P@�I}&O����f��i���@K��t���x0������|.L"yInE!��!��$����/�$��$Kg^0��p��}�{����O�0���~}:ػ��Q�F����R."��Ƕ��!�%NJ��cW��`o��R��l��vm���my3La㋡�i?5ۤ`�;2.�q7�q��~�1�&��&�w�������%W�ؗ6'3����?~�D�?��+�G�v |T,t�Szj�#|?}��s_[�ˡ]���#�Fj�g���L������#�+�h� �������h�	]���~&[�G9�^��m2#���M���w��/��ܞ�����q��#�� 浚w"���nC�;�����`2jX�xB%��,O�/��C�47B�6`�TÀWC�6z/�H�+b(�CA����t��K>S~�*:bj��B�~*�wM���l�]�i�3ЗG�F ��p闵s���:�?�=dS��'>��5��1��\����E��"�=
y}���>���ס��h�3�����s��̨w����D|-�:�*T�Y^�ҝ0�?�G�]$q!]��W���@F�߾9ͨ�}^!�G��?O)��x����5睫�
T0�s0k��VR��}��q�cM��K��&A�d<���5��Ԣ�%�Gj{�VMv�zS��qisgl�P"��yn��cْ��J�i�Ė��[�aV��7�E0�ާ��"��s�-�Z#�����O�#Pk	V0�І�'��y`)?�A�qb?\�ʘ_��>QA�N��b�ŧ7R%�93b���KO�O|uKd]+�(kz��������.���o�>/.������������OW[��s+g����ʞ��q9�u+t*�@�������^,�l����Ӽ��[�����Y���Ә�Y=	�*���>Q�����1�K":��vR�̿�A�ѿ�����۲������R�|�Y�n����`4oڹ��f��4�zN��o���AŌ�|������!n�1���Z;�}�I��7���x׵�X��)BD��Ə0���LU��a��ƾ�x���N'�ċ��H���D�-�UK'.�g��7�&��e�'���k���޿�lL����X�~��L���{a����9#��J���D2|���L9(n�=s*7�r0{Rq~z��o���I�P%��B�g���ڑ�%���ʲ#ϳu�WXq��ʉ=;J�4��1�WH향�Ԉ�D'�[JC��2o�7�S�Δ!�ܥ�4��ƞg/�Z�7`���X���-$���]͖M�?��TUѷ;:0��F��[$�2���<�u_F��mA��Ɋ�:��\�J�[I���n}VW��������%T��t̤`�_��A��jv^����,r#k�>�@��T[PDw��/��/��m��� �����c�G̢Mq��fIW'SݝP��Niq����A7���l�n�`��N�>�u^;��q���v�ه:d�{��=}�xG$9�9lH���w�GGG�iޝ/      ;   D  x�m�ˊ�@E׮��(H.�C��j`���E�F�ЌI����C ��7���4x	]`,��+3H��vO�d�����:-�0` �3Ų���9#�>�B� ��*��L)��<}y���z�>��U/����q��z	g�XXΘ��R�� !����3PS���������y*Θ�dYC���O�M=Ԝ��Zg]�M/7�����Dg�a�H#5�" 1(dψ1�1��y�o���LR|.�Ϙ��4y�����Q��V����:��o�|��G/���ʽ#TS`G�B��b��짯[�˶�GC(�g�}����ܓ�      0   �  x��RKs�0<ۿ����DL3=�<HĄ�4��r �����+;�LO=�#�4��>�����`U���i ���2�N )Ӫ�;����̍F�t�~�#�uۦ��L���{ѝL�,?L$����uٟ~@$�}��e����@N8Y��r�]�o���{?^�4�5@��mV;z>t��]��>��M��-_���U�w~)����*(��shE��E+�x��c�^m�U[��T$�����`w��sq�=�h��-*P<�5�7�UfW�\Yk�9?�G�c[���x1�M�3�M�Hm�`b����@��XS4T�e�\9�:A���9ͱ�G+%7�:C��'6��Z����K}�Rc���#�C�bl�p��k����"7f��"A�n�n�4[�o����1�g�D��Nse�Me�>�@�x55������`�7�i��"��{fU�Q��߲w�!��}q�d�����?a�q�M-o��j0�*Go��6_�2{�����7�E��!��CR1DOE����JDس�VnL.dH����v�n	0�bG�M����!	��r��H��e�z�7T��"��7[��=s!��PT-��s��5L�]�i<s�a�J��n��4ȏ�Y��@�X��˚"=ے�
�0�ލ��_��N�      6   B  x�}�M��0���)�,D�ԏ�1�n(Q��"@�_:�t�Q	�g����U,��2� ��@�bu!��Z�W�}��~�џ?�bz��/�c�.�������ә�∴*�2�.��h������]�j�W�O�����_}��qKG�M��>�$`NX@��y q��i�-�a�X'�q�Hδ0��u<`p_��ڴ�J�B�+ˉ���>�;�_� �-�3-X�I]&`c6i�%���*��n��ӗ.oA"��Ӷ�z�.hu&��ȡ���	�G�9�j���#�)i�c�7-pG��t�	��ͥh�W�Tl����Itk����k��L�9��:� n>F��aхz�ཫg��K�'ԺI9�B�q���Í%Y�JΐP
��/���0d�	*����>�0*I��I�|l�o�^	)/4��G�z�&t�=&��b9�B��h��T�.Y���(��a��L���9�#_'X���Q=ӂ"&�\�z�yj�І\��dry�,��s�ﷄ�����Z�n��ia�9ԛ�,���%B���*�lSjn�^Ѿ�~'򗿴k���y�oH�ơr����B,�v�      7   {   x�m̱1 �:����c;r��	�ƉMbzz���yQ�P�nd�N�3�nn��������SpC,� *�����v�#�d�ٔ <$��,N1鍣\}=�텷1�ّ��޶Z�@M*�      .   T  x����n�@���p.��/��`+���hk��ZE��B��t�ƤɷzOr�	�R�8dFxPJ� �=�\!�'\ �jw|*+�;��T�M���Ť�Oc��vM��߯�'�M�w·;��Ǿn�
&w��5�l��>W)�~8��O�""����O�Oٯ&|L|�-�4׎���- ÌB�$�B�!�	�J?���%�i�,���a�����u���橘��5�9�s�z�D��@����d���b�!�Ǯ�ѣfi�DR	55
2�TH!�v�T�pW��c����r4̒ieg�a��Ԭ�q��f�_/���Z���eRrQG��?k;�<j�ƶ,�\��     