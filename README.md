<h1>Шаблон для создания приложения "Yii2 + API + VueJS" на основе Yii2 Advanced Project Template</h1>

<h3>I. Общая часть</h3>

1. Создаем локальную копию репозитория
   ```
    git clone http://192.168.15.169:3000/complete/yii2-vue-extended.git
   ```

2. Создаем папку **/vendor** для Yii2. Для этого выполним из корня репозитория:
   ```
    composer update
   ```

3. Инициализируем приложение Yii2 (создать index.php, main.php, params.php, test.php). Для этого выполним из корня репозитория:
   ```
    php init
   ```

4. Создаем **/app/node_modules**. Для этого выполним из папки **/app**:
   ```
    npm update
   ```
   
5. Настраиваем виртуальные хосты Apache:
  - для веб-сервера Yii2 API:
```
<VirtualHost *:80>
  ServerName mike.api.test
  DocumentRoot "ПУТЬ-ДО-РЕПОЗИТОРИЯ/api/web"
  <Directory "ПУТЬ-ДО-РЕПОЗИТОРИЯ/api/web">
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule . index.php
      DirectoryIndex index.php
    </IfModule>
  </Directory>
</VirtualHost>
```

  - для веб-сервера сайта (приложения VueJS):
```
<VirtualHost *:80>
  ServerName mike.app.test
  DocumentRoot "ПУТЬ-ДО-РЕПОЗИТОРИЯ/app/dist"
  <Directory "ПУТЬ-ДО-РЕПОЗИТОРИЯ/app/dist">
    <IfModule mod_rewrite.c>
      RewriteEngine On
      RewriteBase /
      RewriteRule ^index\.html$ - [L]
      RewriteCond %{REQUEST_FILENAME} !-f
      RewriteCond %{REQUEST_FILENAME} !-d
      RewriteRule . /index.html [L]
      DirectoryIndex index.html
    </IfModule>
  </Directory>
</VirtualHost>
```

6. Редактируем файлы окружения (используется для *baseURL* в **/app/src/services/http.service.js**):
  - **/app/.env**, задать URL для Yii2 API (production-сервер):
    ```
     VUE_APP_API_BASEURL=http://APP-PRODUCTION-DOMAIN/
    ```
  - **/app/.env.local**, добавить URL для API (development-сервер):
    ```
     VUE_APP_API_BASEURL=http://APP-DEVELOPMENT-DOMAIN/
    ```

7. Настраиваем доступ к БД в **/common/config/main-local.php**, отредактировав секцию *['components']['db']*:
  ```
     'class' => 'yii\db\Connection',
     'dsn' => 'mysql:host=localhost;port=3307;dbname=test',
     'username' => 'root',
     'password' => '',
     'charset' => 'utf8',
  ```

Далее возможны два варианта использования данного шаблона:

  - настройка приложения на основе предложенного примера
  - настройка самостоятельного приложения

<h3>II-a. Настройка приложения на основе предложенного примера</h3>

1. Создаем таблицу-пример в БД `test`:
```
  CREATE TABLE `samples` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `title` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8;

  INSERT INTO `samples`(`title`) VALUES('Первая запись');
  INSERT INTO `samples`(`title`) VALUES('Вторая запись');
  INSERT INTO `samples`(`title`) VALUES('Третья запись');
```

<h3>II-b. Настройка самостоятельного приложения</h3>

1. Редактируем *ServerName* в настройках виртуальных хостов Apache:
  - для веб-сервера Yii2 API  (условно, на *API-TEST-DOMAIN*):
  ```
    ServerName mike.api.test
  ```
  - для веб-сервера сайта (приложения VueJS - условно, на *APP-PRODUCTION-DOMAIN* или *APP-DEVELOPMENT-DOMAIN*):
  ```
    ServerName mike.app.test
  ```
  
2. Создаем собственные стили, заменив и/или отредактировав файлы: **/app/src/styles/index.scss**, **/app/src/styles/fonts/fonts.scss**, **/app/src/styles/common/links.scss**, **/app/src/styles/common/pages.scss** и подключить их в **/app/src/main.js**:
  ```
    import './styles/fonts/index.scss';
  ```
  
3. Установливаем собственные шрифты в папке **/app/src/assets/fonts/**, подключаем их в **/app/src/main.js**:
  ```
    import './styles/fonts/fonts.scss';
  ```

4. Cоздаем собственные контроллеры и модели, заменив и/или отредактировав **/api/controllers/SampleController.php** и **/common/models/Sample.php**

5. Добавляем свои правила в **/api/config/main.php** секцию *['components']['urlManager']['rules']*:
    ```
      'GET sample/samples' => 'sample/samples',
      'OPTIONS sample/samples' => 'sample/options',
    ```

6. Проверяем работу API (http://API-TEST-DOMAIN/sample/samples). Ответ должен быть таким:
```
  <response>
    <item>
      <id>1</id>
      <title>Первая запись</title>
    </item>
    <item>
      <id>2</id>
      <title>Вторая запись</title>
    </item>
    <item>
      <id>3</id>
      <title>Третья запись</title>
    </item>
  </response>
```

<h5>Пример подключения компонентов</h5>
1. Для самостоятельного приложения создаем собственные компоненты или редактируем **/app/src/components/GetApiData.vue** для отображения результатов запроса к БД. 

2. В скрипте **/app/src/pages/About.vue**:
- подключаем компонент *GetApiData* и передать в него данные из запроса к БД:
  ```
     <GetApiData
       v-if="dsSamples.length > 0"
       :dsSamples="dsSamples"
     />
  ```

- подключаем импорт компонента *GetApiData*:
  ```
    import GetApiData from '@/components/GetApiData.vue'
  ```

- настраиваем компонент *GetApiData*:
  ```
      components: {
        GetApiData
      },
      data () {
        return {
          dsSamples: [],
        }
      },
      async mounted () {
        let error = null;
        //-- запросить данные, сохранить в dsSamples: controller = Sample, action = Samples
        const {status, data} = await httpClient.get('sample/samples');
        if(status === 200) {
          this.dsSamples = data;
        } else {
          console.log(status,data, error);
        }
      }
  ```

<h3>III. Заключительная часть</h3>

Проверяем работу сайта с API из папки **/app**, выполнив:
 
- в тестовом режиме (веб-сайт будет доступен по ссылке http://localhost:8080/):
  ```
    npm run serve
  ```
  
- в боевом режиме (будет создана папка **/app/dist**, веб-сайт будет доступен по ссылкам http://APP-PRODUCTION-DOMAIN/ или http://APP-DEVELOPMENT-DOMAIN/):
  ```
    npm run build
  ```
     