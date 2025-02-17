import Image from "next/image";
import { Geist, Geist_Mono } from "next/font/google";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export default function Home() {
  return (
      <div className="flex min-h-screen items-center justify-center bg-gray-100">
          <h1 className="text-4xl font-bold text-blue-600">Hello, Next.js + Tailwind!</h1>
      </div>
  );
}

