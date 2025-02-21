# This is an VUE + Laravel prototype project for generating certificates using [PDF Generator API](https://app.pdfgeneratorapi.com/).

## Backend (Laravel) Setup
```bash
composer install
```

```bash
cp .env.example .env
```

## Then open your .ENV file that has been copied and fill in the API credentials that you've created on PDF Generators API website.
### If you've not generated this yet or made any changes please do so before you continue here: [PDF Generator API](https://app.pdfgeneratorapi.com/)
```bash
PDF_API_KEY=your_api_key
PDF_API_SECRET=your_api_secret
WORKSPACE_ID=your_workspace_id
TEMPLATE_ID=your_template_id
```
## And then the last step before running:

```bash
php artisan key:generate
```

## And run back-end by using this
```bash
php artisan serve
```

## Frontend (Vue) Setup

### Go to the frontend directory and run the following:

```bash
npm install
# or
yarn install
```

### Then run the development server
```
npm run dev
#or
yarn dev
```

### Then open the frontend link it shows.
### And fill out the form and it will give you a download link to get your certificaate
