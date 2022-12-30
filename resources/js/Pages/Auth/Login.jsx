import { useEffect } from "react";
import { useState } from "react";
import GuestLayout from "@/Layouts/GuestLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/inertia-react";
import { Button } from "@chakra-ui/react";
import { ChakraProvider } from "@chakra-ui/react";

export default function Login({ status, canResetPassword }) {
    const [loader, setLoader] = useState(false);
    const { data, setData, post, processing, errors, reset } = useForm({
        email: "",
        password: "",
    });

    const onClickButton = () => {
        setLoader(!loader);
    };

    useEffect(() => {
        return () => {
            reset("password");
        };
    }, []);

    const onHandleChange = (event) => {
        setData(
            event.target.name,
            event.target.type === "checkbox"
                ? event.target.checked
                : event.target.value
        );
    };

    const submit = (e) => {
        e.preventDefault();

        post(route("login"));
    };

    return (
        <ChakraProvider>
            <GuestLayout>
                <Head title="Log in" />

                {status && (
                    <div className="mb-4 font-medium text-sm text-green-600">
                        {status}
                    </div>
                )}
                <div>
                    <InputError message={errors.failed} className="mt-2" />
                </div>

                <form onSubmit={submit}>
                    <div className="mt-3">
                        <InputLabel forInput="email" value="メールアドレス" />
                        <InputError message={errors.email} className="mt-2" />
                        <TextInput
                            id="email"
                            type="email"
                            name="email"
                            value={data.email}
                            className="mt-1 block w-full"
                            autoComplete="username"
                            isFocused={true}
                            handleChange={onHandleChange}
                        />
                    </div>

                    <div className="mt-4">
                        <InputLabel forInput="password" value="パスワード" />

                        <InputError
                            message={errors.password}
                            className="mt-2"
                        />
                        <TextInput
                            id="password"
                            type="password"
                            name="password"
                            value={data.password}
                            className="mt-1 block w-full"
                            autoComplete="current-password"
                            handleChange={onHandleChange}
                        />
                    </div>

                    <div className="flex items-center justify-end mt-4">
                        {canResetPassword && (
                            <Link
                                href={route("password.request")}
                                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Forgot your password?
                            </Link>
                        )}

                        <Button
                            colorScheme="teal"
                            variant="outline"
                            className="mx-auto"
                            type="submit"
                            loadingText="処理中"
                            onClick={onClickButton}
                        >
                            ログイン
                        </Button>
                    </div>
                </form>
            </GuestLayout>
        </ChakraProvider>
    );
}
