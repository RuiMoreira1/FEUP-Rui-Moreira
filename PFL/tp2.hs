import Data.Char
import Data.Map hiding (splitAt)
import Data.List
{- Exercise 2.1 Pratical sheet 2 -}

sum' :: Int -> Int 
sum' a = sum[ x^2 | x <- [1..a] ]

{- Exercise 2.2 a) Pratical sheet 2 -}

approx :: Int -> Double
approx n = 4 * sum[ fromIntegral ((-1)^x) / fromIntegral  (2*x+1) | x <- [0..n] ]

{- Exercise 2.2 b) Pratical sheet 2 -}

approx' :: Int -> Double
approx' n = sqrt (12 * sum[ fromIntegral ((-1)^x) / fromIntegral  (x+1)^2 | x <- [0..n] ])

{- Exercise 2.3 Pratical sheet 2 -}

dotProd :: [Float] -> [Float] -> Float
dotProd a b = sum(zipWith (*) a b )

{- Exercise 2.4 Pratical sheet 2 -}

divprop :: Integer -> [Integer]
divprop n = [ x | x <- [1..n-1], mod n x == 0 ]

{- Exercise 2.5 Pratical sheet 2 -}

perfeito :: Integer -> [Integer]
perfeito n = [x | x <- [1..n], sum (divprop x) == x]

{- Exercise 2.6 Pratical sheet 2 -}

pitagoricos :: Integer ->  [(Integer ,Integer ,Integer)]
pitagoricos n = [(x,y,z) | x <- [1..n], y <- [1..n], z <- [1..n], z^2 == x^2 + y^2]

{- Exercise 2.7 Pratical sheet 2 -}

primo :: Integer -> Bool
primo n = length (divprop n) == 1

{- Exercise 2.8 Pratical sheet 2 -}

binom :: Integer -> Integer -> Integer 
binom a b = product [1..a] `div`  (product[1..b] * product[1..(a-b)] )

pascal :: Integer -> [[Integer]]
pascal x = [ l | n <-[1..x], let l = [binom n b | b <- [1..x] ] ]

{- Exercise 2.9 Pratical sheet 2 -}

{- Exercise 2.11 Pratical sheet 2 -}

myconcat :: [[a]] -> [a]
myconcat [] = []
myconcat (x:xs) = x ++ myconcat xs  

myreplicate :: Int -> a -> [a]
myreplicate 0 y = []
myreplicate x y = y:[] ++ (myreplicate (x-1) y)

exclamation :: [a] -> Int -> a
exclamation x (-1) = head x
exclamation x 0 = head x
exclamation (x:xs) y = exclamation xs (y-1)

{- Exercise 2.12 Pratical sheet 2 -}

forte :: String -> Bool
forte s = length s >= 8 && any isDigit s && any isUpper s && any isLower s

{- Exercise 2.14 Pratical sheet 2 -}
 
nub' :: Eq a => [a] -> [a]
nub' [] = []
nub' (x:xs) = x : nub' [a | a <- xs, a /= x ]

{- Exercise 2.15 Pratical sheet 2 -}

intersperse' :: a -> [a] -> [a]
intersperse' _ [] = []
intersperse' _ [a] = [a]
intersperse' v (x:xs) = x : v : intersperse' v xs

{- Exercise 2.16 Pratical sheet 2 -}

algarismos :: Int -> [Int]
algarismos 0 = [] 
algarismos a = (algarismos (a `div` 10)) ++ [a `mod` 10]

{- Exercise 2.17 Pratical sheet 2 -}

toBits :: Int -> [Int]
toBits 0 = []
toBits a = (toBits (a `div` 2)) ++ [a `mod` 2]

{- Exercise 2.18 Pratical sheet 2 -}

fromBits :: [Int] -> Int
fromBits  [] = 0
fromBits (x:xs) = (x * (2 ^ length xs )) + fromBits xs 

{- Exercise 2.19 Pratical sheet 2 -}

mdc :: Integer -> Integer -> Integer 
mdc x 0 = x
mdc x y = mdc y (x `mod` y) 

{- Exercise 2.20 a) Pratical sheet 2 -}

insert' :: Ord a => a -> [a] -> [a]
insert' x [] = [x]
insert' x (y:ys)
    | x > y = y : (insert' x ys)
    | x <= y = x : y : ys


{- Exercise 2.20 b) Pratical sheet 2 -}

isort' :: Ord a => [a] -> [a]
isort' [] = []
isort' [a] = [a]
isort' x = insert' (last x) ( isort' (init x))

{- Exercise 2.21 a= Pratical sheet 2 -}

minimum' :: Ord a => [a] -> a
minimum' [a] = a
minimum' (x:y:xs)
    | x > y = minimum' (y : xs)
    | otherwise = minimum'(x : xs)

{- Exercise 2.21 b) Pratical sheet 2 -}

delete' :: Eq a => a -> [a] -> [a]
delete' x (y:ys)
    | x /= y = y : delete' x ys
    | otherwise = ys

{- Exercise 2.21 c) Pratical sheet 2 -}

ssort :: Ord a => [a] -> [a]
ssort [] = []
ssort [a] = [a]
ssort x = mine : ssort (delete' mine x) 
    where mine = minimum' x

{- Exercise 2.22 a) Pratical sheet 2 -}

merge :: Ord a => [a] -> [a] -> [a]
merge [] y = y
merge (x:xs) y = merge xs (insert' x y)

{- Exercise 2.22 b) Pratical sheet 2 -}

metades :: [a] -> ([a],[a])
metades myList = splitAt (div (length myList) 2) myList

msort :: Ord a => [a] -> [a]
msort [] = []
msort [a] = [a]
msort [a, b] = if a < b then [a, b] else [b, a]
msort l = let met = metades l in merge (msort (fst met)) (msort (snd met))