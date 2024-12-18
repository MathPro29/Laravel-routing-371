import { Link } from '@inertiajs/react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

export default function Show({product}) {
    return (
        <>
        <AuthenticatedLayout>
        <div>
            <h1>{product.name}</h1>
            <p>{product.description}</p>
            <p>Price: ${product.price}</p>
            <Link href="/products">Back to All Products</Link>
        </div>
        </AuthenticatedLayout>
        </>
    );
}
